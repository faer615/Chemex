<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\SoftwareTrackDisableAction;
use App\Admin\Repositories\SoftwareTrack;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;

class SoftwareTrackController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new SoftwareTrack(['software', 'device']), function (Grid $grid) {
            $grid->column('id');
            $grid->column('software.name');
            $grid->column('device.name');
            $grid->column('created_at');
            $grid->column('updated_at');

            $grid->disableCreateButton();
            $grid->disableRowSelector();
            $grid->disableBatchDelete();
            $grid->disableViewButton();
            $grid->disableEditButton();
            $grid->disableDeleteButton();

            $grid->setActionClass(Grid\Displayers\Actions::class);

            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->append(new SoftwareTrackDisableAction());
            });

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
        return Show::make($id, new SoftwareTrack(['software', 'device']), function (Show $show) {
            $show->field('id');
            $show->field('software.name');
            $show->field('device.name');
            $show->field('created_at');
            $show->field('updated_at');

            $show->disableEditButton();
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
        return Form::make(new SoftwareTrack(), function (Form $form) {
            $form->display('id');
            $form->text('software_id');
            $form->text('device_id');

            $form->display('created_at');
            $form->display('updated_at');

            $form->disableDeleteButton();
            $form->disableViewButton();
        });
    }
}
