<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\RowAction\DeviceDeleteAction;
use App\Admin\Actions\Grid\RowAction\DeviceTrackAction;
use App\Admin\Actions\Grid\RowAction\MaintenanceAction;
use App\Admin\Actions\Grid\ToolAction\DeviceRecordImportAction;
use App\Admin\Grid\Displayers\RowActions;
use App\Admin\Repositories\DeviceRecord;
use App\Models\DepreciationRule;
use App\Models\DeviceCategory;
use App\Models\PurchasedChannel;
use App\Models\VendorRecord;
use App\Services\DeviceRecordService;
use App\Services\ExpirationService;
use App\Services\ExportService;
use App\Support\Info;
use App\Traits\HasDeviceRelatedGrid;
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

/**
 * @property int id
 * @property double price
 * @property string purchased
 * @property int depreciation_rule_id
 */
class DeviceRecordController extends AdminController
{
    use HasDeviceRelatedGrid;


    /**
     * 详情页构建器
     * 为了复写详情页的布局
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content): Content
    {
        $name = Info::deviceIdToStaffName($id);
        $history = DeviceRecordService::history($id);
        return $content
            ->title($this->title())
            ->description($this->description()['index'] ?? trans('admin.show'))
            ->body(function (Row $row) use ($id, $name, $history) {
                $column_b_width = 0;
                $column_c_width = 0;
                // 如果B和C权限都有
                if (Admin::user()->can('device.related') && Admin::user()->can('device.history')) {
                    $column_a_width = 4;
                    $column_b_width = 4;
                    $column_c_width = 4;
                } elseif (Admin::user()->can('device.related') && !Admin::user()->can('device.history')) {
                    // 如果只有B
                    $column_a_width = 6;
                    $column_b_width = 6;
                } elseif (!Admin::user()->can('device.related') && Admin::user()->can('device.history')) {
                    //如果只有C
                    $column_a_width = 6;
                    $column_c_width = 6;
                } else {
                    $column_a_width = 12;
                }
                $row->column($column_a_width, $this->detail($id));
                $row->column($column_b_width, function (Column $column) use ($id, $name, $history) {
                    $column->row(Card::make()->content('当前使用者：' . $name));
                    if (Admin::user()->can('device.related')) {
                        $result = self::hasDeviceRelated($id);
                        $column->row(new Card('硬件', $result['hardware']));
                        $column->row(new Card('软件', $result['software']));
                        $column->row(new Card('服务程序', $result['service']));
                    }
                });
                if (Admin::user()->can('device.history')) {
                    $card = new Card('履历', view('history')->with('data', $history));
                    $row->column($column_c_width, $card->tool('<a class="btn btn-primary btn-xs" href="' . route('export.device.history', $id) . '" target="_blank">导出到 Excel</a>'));
                }
            });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id): Show
    {
        return Show::make($id, new DeviceRecord(['category', 'vendor', 'channel', 'staff', 'staff.department', 'depreciation']), function (Show $show) {
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
            //TODO 对安全密码和管理员密码做权限设定
            $show->field('staff.name');
            $show->field('staff.department.name');
            $show->field('security_password');
            $show->field('admin_password');
            $show->field('depreciation.name');
            $show->field('', admin_trans_label('Depreciation Price'))->as(function () {
                $device_record = \App\Models\DeviceRecord::where('id', $this->id)->first();
                if (!empty($device_record)) {
                    $depreciation_rule_id = Info::getDepreciationRuleId($device_record);
                    return Info::depreciationPrice($this->price, $this->purchased, $depreciation_rule_id);
                }
            });
            $show->field('created_at');
            $show->field('updated_at');

            $show->disableDeleteButton();
        });
    }

    /**
     * 履历导出
     * @param $device_id
     * @return mixed
     */
    public function exportHistory($device_id)
    {
        return ExportService::DeviceHistory($device_id);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        return Grid::make(new DeviceRecord(['category', 'vendor', 'staff', 'staff.department', 'depreciation']), function (Grid $grid) {

            $grid->column('id');
            $grid->column('qrcode')->qrcode(function () {
                return base64_encode('device:' . $this->id);
            }, 200, 200);
            $grid->column('photo')->image('', 50, 50);
            $grid->column('name')->display(function ($name) {
                $tag = Info::getSoftwareIcon($this->id);
                if (empty($tag)) {
                    return $name;
                } else {
                    return "<img alt='$tag' src='/static/images/icons/$tag.png' style='width: 25px;height: 25px;margin-right: 10px'/>$name";
                }
            });
            $grid->column('description');
            $grid->column('category.name');
            $grid->column('vendor.name');
            $grid->column('sn');
            $grid->column('mac');
            $grid->column('ip');
            $grid->column('price');
            $grid->column('expired');
            $grid->column('staff.name');
            $grid->column('staff.department.name');
            $grid->column('expiration_left_days', admin_trans_label('Expiration Left Days'))->display(function () {
                return ExpirationService::itemExpirationLeftDaysRender('device', $this->id);
            });
            $grid->column('depreciation.name');

            $grid->disableRowSelector();
            $grid->disableBatchActions();
            $grid->disableDeleteButton();
            $grid->tools([
                new DeviceRecordImportAction()
            ]);

            $grid->actions(function (RowActions $actions) {
                if (Admin::user()->can('device.delete')) {
                    $actions->append(new DeviceDeleteAction());
                }
                if (Admin::user()->can('device.track')) {
                    $actions->append(new DeviceTrackAction());
                }
                if (Admin::user()->can('device.maintenance')) {
                    $actions->append(new MaintenanceAction('device'));
                }
            });

            $grid->showColumnSelector();
            $grid->hideColumns(['description', 'price', 'expired']);

            $grid->quickSearch(
                'id',
                'name',
                'description',
                'category.name',
                'vendor.name',
                'sn',
                'mac',
                'ip',
                'price',
                'staff.name',
                'staff.department.name'
            )
                ->placeholder('试着搜索一下')
                ->auto(false);

            $grid->selector(function (Selector $selector) {
                $selector->select('category_id', '设备分类', DeviceCategory::all()
                    ->pluck('name', 'id'));
                $selector->select('vendor_id', '制造商', VendorRecord::all()
                    ->pluck('name', 'id'));
            });

            $grid->enableDialogCreate();
            $grid->toolsWithOutline(false);
            $grid->export();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        return Form::make(new DeviceRecord(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->select('category_id', admin_trans_label('Category'))
                ->options(DeviceCategory::all()
                    ->pluck('name', 'id'))
                ->required();
            $form->select('vendor_id', admin_trans_label('Vendor'))
                ->options(VendorRecord::all()->pluck('name', 'id'))
                ->required();
            $form->divider();
            $form->text('description');
            $form->select('purchased_channel_id', admin_trans_label('Purchased Channel Id'))
                ->options(PurchasedChannel::all()
                    ->pluck('name', 'id'));
            $form->text('sn');
            $form->text('mac');
            $form->text('ip');
            $form->image('photo')
                ->autoUpload()
                ->uniqueName()
                ->help('可以选择提供一张设备的照片作为概览。');
            $form->currency('price');
            $form->date('purchased');
            $form->date('expired');
            $form->password('security_password')
                ->help('安全密码，可以代表BIOS密码等。');
            $form->password('admin_password')
                ->help('管理员密码，可以代表计算机管理员账户密码以及打印机管理员密码等。');
            $form->select('depreciation_rule_id', admin_trans_label('Depreciation Rule Id'))
                ->options(DepreciationRule::all()
                    ->pluck('name', 'id'))
                ->help('设备记录的折旧规则将优先于其分类所指定的折旧规则。');
            $form->display('created_at');
            $form->display('updated_at');

            $form->disableDeleteButton();

            $form->disableCreatingCheck();
            $form->disableEditingCheck();
            $form->disableViewCheck();
        });
    }
}
