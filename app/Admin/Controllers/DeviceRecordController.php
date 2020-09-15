<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\DeviceRecord;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Controllers\AdminController;

class DeviceRecordController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new DeviceRecord(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('description');
            $grid->column('category_id');
            $grid->column('vendor_id');
            $grid->column('mac');
            $grid->column('ip');

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
        return Show::make($id, new DeviceRecord(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('description');
            $show->field('category_id');
            $show->field('vendor_id');
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
            $form->text('name');
            $form->text('description');
            $form->text('category_id');
            $form->text('vendor_id');
            $form->text('mac');
            $form->text('ip');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
