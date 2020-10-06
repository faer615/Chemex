<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\ServiceIssue;
use App\Libraries\Data;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;

class ServiceIssueController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new ServiceIssue(), function (Grid $grid) {
            $grid->column('id');
            $grid->column('issue');
            $grid->column('status')->using(Data::serviceIssueStatus());
            $grid->column('start');
            $grid->column('end');

            $grid->filter(function (Grid\Filter $filter) {
                $filter->equal('id');
            });
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
        return Show::make($id, new ServiceIssue(), function (Show $show) {
            $show->field('id');
            $show->field('issue');
            $show->field('status')->using(Data::serviceIssueStatus());
            $show->field('start');
            $show->field('end');
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
//        return Form::make(new ServiceIssue(), function (Form $form) {
//            $form->display('id');
//            $form->text('issue');
//            $form->text('status');
//            $form->text('start');
//            $form->text('end');
//
//            $form->display('created_at');
//            $form->display('updated_at');
//        });
    }
}
