<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\DeviceHistoryAction;
use App\Admin\Actions\Grid\DeviceRelatedAction;
use App\Admin\Actions\Grid\DeviceTrackAction;
use App\Admin\Repositories\DeviceRecord;
use App\Libraries\InfoHelper;
use App\Libraries\TrackHelper;
use App\Models\DeviceCategory;
use App\Models\VendorRecord;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Grid\Tools\Selector;
use Dcat\Admin\Show;

class DeviceRecordController extends AdminController
{
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
                $tag = InfoHelper::getOSTag($this->id);
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
                $res = TrackHelper::currentDeviceTrackStaff($this->id);
                switch ($res) {
                    case -1:
                        return '雇员失踪';
                    case 0:
                        return '闲置';
                    default:
                        return InfoHelper::staffIdToName($res);
                }
            });
            $grid->column('department')->display(function () {
                $res = TrackHelper::currentDeviceTrackStaff($this->id);
                if ($res < 0) {
                    return '';
                }
                return InfoHelper::staffIdToDepartmentName($res);
            });

            $grid->actions([new DeviceTrackAction(), new DeviceRelatedAction(), new DeviceHistoryAction()]);

            $grid->quickSearch('id', 'name')
                ->placeholder('输入ID或者名称以搜索')
                ->auto(false);

            $grid->selector(function (Selector $selector) {
                $selector->select('category_id', '设备分类', DeviceCategory::all()->pluck('name', 'id'));
                $selector->select('vendor_id', '制造商', VendorRecord::all()->pluck('name', 'id'));
            });

            $grid->enableDialogCreate();
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
        return Show::make($id, new DeviceRecord(['category', 'vendor']), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('description');
            $show->field('category.name');
            $show->field('vendor.name');
            $show->field('sn');
            $show->field('mac');
            $show->field('ip');
            $show->field('created_at');
            $show->field('updated_at');
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
            $form->text('sn');
            $form->text('mac');
            $form->ip('ip');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
