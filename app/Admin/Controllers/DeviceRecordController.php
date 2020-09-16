<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\DeviceTrackAction;
use App\Admin\Repositories\DeviceRecord;
use App\Libraries\TrackHelper;
use App\Models\DeviceCategory;
use App\Models\VendorRecord;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
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
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('description');
            $grid->column('category.name');
            $grid->column('vendor.name');
            $grid->column('sn');
            $grid->column('mac');
            $grid->column('ip');
            $grid->column('', admin_trans_label('Owner'))->display(function () {
                return TrackHelper::currentDeviceTrack($this->id);
            });

            $grid->actions([new DeviceTrackAction()]);

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            });
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
        return Form::make(new DeviceRecord(['category', 'vendor']), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->text('description');
            $form->select('category.name')->options(DeviceCategory::all()->pluck('name', 'id'));
            $form->select('vendor.name')->options(VendorRecord::all()->pluck('name', 'id'));
            $form->text('sn');
            $form->text('mac');
            $form->ip('ip');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
