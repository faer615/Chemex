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
        return Grid::make(new HardwareTrack(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('hardware_id');
            $grid->column('device_id');
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
        return Show::make($id, new HardwareTrack(), function (Show $show) {
            $show->field('id');
            $show->field('hardware_id');
            $show->field('device_id');
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
