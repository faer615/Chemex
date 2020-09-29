<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\CheckRecord;
use App\Libraries\Data;
use App\Models\StaffRecord;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;

class CheckRecordController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new CheckRecord(['staff']), function (Grid $grid) {
            $grid->column('id');
            $grid->column('check_item')->using(Data::items());
            $grid->column('start_time');
            $grid->column('end_time');
            $grid->column('staff.name');

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
        return Show::make($id, new CheckRecord(['staff']), function (Show $show) {
            $show->field('id');
            $show->field('check_item');
            $show->field('start_time');
            $show->field('end_time');
            $show->field('staff.name');
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
        return Form::make(new CheckRecord(), function (Form $form) {
            $form->display('id');
            $form->select('check_item')
                ->options(Data::items())
                ->required();
            $form->datetime('start_time')
                ->required();
            $form->datetime('end_time')
                ->required();
            $form->select('staff_id', admin_trans_label('Staff'))
                ->options(StaffRecord::all()
                    ->pluck('name', 'id'))
                ->required();

            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
