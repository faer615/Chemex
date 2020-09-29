<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\CheckTrack;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;

class CheckTrackController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new CheckTrack(), function (Grid $grid) {
            $grid->column('id');
            $grid->column('check_id');
            $grid->column('item_id');
            $grid->column('status');
            $grid->column('checker');
            $grid->column('created_at');
            $grid->column('updated_at');

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
        return Show::make($id, new CheckTrack(), function (Show $show) {
            $show->field('id');
            $show->field('check_id');
            $show->field('item_id');
            $show->field('status');
            $show->field('checker');
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
        return Form::make(new CheckTrack(), function (Form $form) {
            $form->display('id');
            $form->text('check_id');
            $form->text('item_id');
            $form->text('status');
            $form->text('checker');

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
