<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\ClipTrack;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;
use Dcat\Admin\Http\Controllers\AdminController;

class ClipTrackController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new ClipTrack(), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('item');
            $grid->column('item_id');
            $grid->column('clip_id');
            $grid->column('creator');
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
        return Show::make($id, new ClipTrack(), function (Show $show) {
            $show->field('id');
            $show->field('item');
            $show->field('item_id');
            $show->field('clip_id');
            $show->field('creator');
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
        return Form::make(new ClipTrack(), function (Form $form) {
            $form->display('id');
            $form->text('item');
            $form->text('item_id');
            $form->text('clip_id');
            $form->text('creator');
        
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
