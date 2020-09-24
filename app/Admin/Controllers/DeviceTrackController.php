<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\DeviceTrack;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;

class DeviceTrackController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new DeviceTrack(['device', 'staff']), function (Grid $grid) {
            $grid->column('id');
            $grid->column('device.name');
            $grid->column('staff.name');
            $grid->column('created_at');
            $grid->column('updated_at');

            $grid->disableCreateButton();

            $grid->disableRowSelector();
            $grid->disableBatchDelete();
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
        return Show::make($id, new DeviceTrack(['device', 'staff']), function (Show $show) {
            $show->field('id');
            $show->field('device.name');
            $show->field('staff.name');
            $show->field('created_at');
            $show->field('updated_at');

            $show->panel()
                ->tools(function ($tools) {
                    $tools->disableEdit();
                    $tools->disableDelete();
                });
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Form::make(new DeviceTrack(), function (Form $form) {
            $form->display('id');
            $form->text('device_id');
            $form->text('staff_id');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
