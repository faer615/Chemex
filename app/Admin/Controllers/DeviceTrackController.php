<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\DeviceTrack;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class DeviceTrackController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new DeviceTrack(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('device_id');
            $grid->column('staff_id');
            $grid->column('created_at');
            $grid->column('updated_at')->sortable();
        
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
        return Show::make($id, new DeviceTrack(), function (Show $show) {
            $show->field('id');
            $show->field('device_id');
            $show->field('staff_id');
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
        return Form::make(new DeviceTrack(), function (Form $form) {
            $form->display('id');
            $form->text('device_id');
            $form->text('staff_id');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
