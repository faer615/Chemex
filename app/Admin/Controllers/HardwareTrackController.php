<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\HardwareTrack;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;

class HardwareTrackController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new HardwareTrack(['hardware', 'device']), function (Grid $grid) {
            $grid->column('id');
            $grid->column('hardware.name');
            $grid->column('device.name');
            $grid->column('created_at');
            $grid->column('updated_at');

            $grid->disableCreateButton();
            $grid->disableRowSelector();
            $grid->disableBatchDelete();

            $grid->toolsWithOutline(false);
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
        return Show::make($id, new HardwareTrack(['hardware', 'device']), function (Show $show) {
            $show->field('id');
            $show->field('hardware.name');
            $show->field('device.name');
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
        return Form::make(new HardwareTrack(), function (Form $form) {
            $form->display('id');
            $form->text('hardware_id');
            $form->text('device_id');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
