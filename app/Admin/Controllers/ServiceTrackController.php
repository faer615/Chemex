<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\ServiceTrack;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;

class ServiceTrackController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new ServiceTrack(['service', 'device']), function (Grid $grid) {
            $grid->column('id');
            $grid->column('service.name');
            $grid->column('device.name');
            $grid->column('created_at');
            $grid->column('updated_at');

            $grid->toolsWithOutline(false);

            $grid->disableCreateButton();
            $grid->disableRowSelector();
            $grid->disableBatchDelete();
            $grid->disableEditButton();
            $grid->disableDeleteButton();
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
        return Show::make($id, new ServiceTrack(), function (Show $show) {
            $show->field('id');
            $show->field('service_id');
            $show->field('device_id');
            $show->field('creator');
            $show->field('created_at');
            $show->field('updated_at');

            $show->disableDeleteButton();
            $show->disableEditButton();
        });
    }

    /**
     * Make a form builder.
     *
     * @return void
     */
    protected function form()
    {
        return;
//        return Form::make(new ServiceTrack(), function (Form $form) {
//            $form->display('id');
//            $form->text('service_id');
//            $form->text('device_id');
//            $form->text('creator');
//
//            $form->display('created_at');
//            $form->display('updated_at');
//        });
    }
}
