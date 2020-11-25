<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\RowAction\DeviceDeleteAction;
use App\Admin\Actions\Grid\RowAction\DeviceHistoryAction;
use App\Admin\Actions\Grid\RowAction\DeviceRelatedAction;
use App\Admin\Actions\Grid\RowAction\DeviceTrackAction;
use App\Admin\Actions\Grid\RowAction\MaintenanceAction;
use App\Admin\Actions\Grid\ToolAction\DeviceRecordImportAction;
use App\Admin\Repositories\DeviceRecord;
use App\Models\ClipRecord;
use App\Models\DeviceCategory;
use App\Models\PurchasedChannel;
use App\Models\VendorRecord;
use App\Services\DeviceRecordService;
use App\Services\ExpirationService;
use App\Support\Info;
use App\Support\Track;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\Tools\Selector;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Show;
use Dcat\Admin\Widgets\Card;

class DeviceRecordController extends AdminController
{
    public function index(Content $content)
    {
        return $content
            ->title($this->title())
            ->description($this->description()['index'] ?? trans('admin.list'))
            ->body(function (Row $row) {
                $row->column(3, new Card('30天内即将过保设备数', ExpirationService::deviceCounts()));
            })
            ->body($this->grid());
    }

    public function show($id, Content $content)
    {
        $name = Info::deviceIdToStaffName($id);
        $data = DeviceRecordService::related($id);
        return $content
            ->title($this->title())
            ->description($this->description()['index'] ?? trans('admin.show'))
            ->body(function (Row $row) use ($id, $name, $data) {
                // 判断权限
                if (!Admin::user()->can('device.history')) {
                    $row->column(12, $this->detail($id));
                } else {
                    $row->column(6, $this->detail($id));
                    $row->column(6, function (Column $column) use ($id, $name, $data) {
                        $column->row(new Card(view('device_records.staff')->with('name', $name)));
                        $column->row(new Card('归属信息', view('device_records.related')->with('data', $data)));
                    });
                }
            });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new DeviceRecord(['category', 'vendor']), function (Grid $grid) {

            $grid->column('id');
            $grid->column('qrcode')->qrcode(function () {
                return base64_encode('device:' . $this->id);
            }, 200, 200);
            $grid->column('name')->display(function ($name) {
                $tag = Info::getSoftwareIcon($this->id);
                if (empty($tag)) {
                    return $name;
                } else {
                    return "<img src='/static/images/icons/$tag.png' style='width: 25px;height: 25px;margin-right: 10px'/>$name";
                }
            });
            $grid->column('category.name');
            $grid->column('vendor.name');
            $grid->column('sn');
            $grid->column('mac');
            $grid->column('ip');
            $grid->column('owner')->display(function () {
                $res = Track::currentDeviceTrackStaff($this->id);
                switch ($res) {
                    case -1:
                        return '雇员失踪';
                    case 0:
                        return '闲置';
                    default:
                        return Info::staffIdToName($res);
                }
            });
            $grid->column('department')->display(function () {
                $res = Track::currentDeviceTrackStaff($this->id);
                if ($res < 0) {
                    return '';
                }
                return Info::staffIdToDepartmentName($res);
            });

            $grid->toolsWithOutline(false);

            $grid->disableDeleteButton();

            $grid->tools([
                new DeviceRecordImportAction()
            ]);

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                if (Admin::user()->can('device.delete')) {
                    $actions->append(new DeviceDeleteAction());
                }
                if (Admin::user()->can('device.track')) {
                    $actions->append(new DeviceTrackAction());
                }
                if (Admin::user()->can('device.related')) {
                    $actions->append(new DeviceRelatedAction());
                }
                if (Admin::user()->can('device.history')) {
                    $actions->append(new DeviceHistoryAction());
                }

//                if (!empty($this->ip) && !empty($this->ssh_username) && !empty($this->ssh_password) && !empty($this->ssh_port)) {
//                    $url = Info::getSSHBaseUrl($this->ip, $this->ssh_port, $this->ssh_username, $this->ssh_password);
//                    $web_ssh_status = System::checkWebSSHServiceStatus($url);
//                    if ($web_ssh_status == 200) {
//                        $actions->append("<a href='$url' target='_blank'>💻 通过SSH连接...</a>");
//                    } else {
//                        $actions->append("<a disabled>💻 通过SSH连接...（WebSSH服务未启动）</a>");
//                    }
//                }
//                $actions->append(new DeviceSSHInfoAction());

                if (Admin::user()->can('device.maintenance')) {
                    $actions->append(new MaintenanceAction('device'));
                }
            });

            $grid->quickSearch('id', 'name', 'ip', 'mac')
                ->placeholder('试着搜索一下')
                ->auto(false);

            $grid->selector(function (Selector $selector) {
                $selector->select('category_id', '设备分类', DeviceCategory::all()->pluck('name', 'id'));
                $selector->select('vendor_id', '制造商', VendorRecord::all()->pluck('name', 'id'));
            });

            $grid->enableDialogCreate();

            $grid->disableRowSelector();
            $grid->disableBatchActions();

            $grid->export();
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id)
    {
        return Show::make($id, new DeviceRecord(['category', 'vendor', 'channel']), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('description');
            $show->field('category.name');
            $show->field('vendor.name');
            $show->field('channel.name');
            $show->field('sn');
            $show->field('mac');
            $show->field('ip');
            $show->field('photo')->image();
            $show->field('price');
            $show->field('purchased');
            $show->field('expired');
            $show->field('created_at');
            $show->field('updated_at');

            $show->disableDeleteButton();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new DeviceRecord(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->text('description');
            $form->select('category_id', admin_trans_label('Category'))
                ->options(DeviceCategory::all()
                    ->pluck('name', 'id'))
                ->required();
            $form->select('vendor_id', admin_trans_label('Vendor'))
                ->options(VendorRecord::all()
                    ->pluck('name', 'id'))
                ->required();
            $form->select('purchased_channel_id', admin_trans_label('Purchased Channel Id'))
                ->options(PurchasedChannel::all()
                    ->pluck('name', 'id'));
            $form->text('sn');
            $form->text('mac');
            $form->text('ip');
            $form->image('photo')
                ->autoUpload()
                ->uniqueName();
            $form->currency('price');
            $form->date('purchased');
            $form->date('expired');

            $form->display('created_at');
            $form->display('updated_at');

            $form->disableDeleteButton();
        });
    }
}
