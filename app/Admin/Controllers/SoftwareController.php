<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\Software;
use App\Libraries\Data;
use App\Models\SoftwareCategory;
use App\Models\Vendor;
use Dcat\Admin\Controllers\AdminController;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Show;

class SoftwareController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Grid::make(new Software(['category', 'vendor']), function (Grid $grid) {
            $grid->column('id')->sortable();
            $grid->column('name');
            $grid->column('description');
            $grid->column('category.name');
            $grid->column('version');
            $grid->column('vendor.name');
            $grid->column('price');
            $grid->column('purchased');
            $grid->column('expired');
            $grid->column('distribution')->using(Data::distribution());

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
        return Show::make($id, new Software(['category', 'vendor']), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('description');
            $show->field('category.name');
            $show->field('version');
            $show->field('vendor.name');
            $show->field('price');
            $show->field('purchased');
            $show->field('expired');
            $show->field('distribution')->using(Data::distribution());
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
        return Form::make(new Software(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->text('description');
            $form->select('category_id')
                ->options(SoftwareCategory::all()->pluck('name', 'id'))
                ->required();
            $form->text('version')->required();
            $form->select('vendor_id')
                ->options(Vendor::all()->pluck('name', 'id'))
                ->required();
            $form->currency('price');
            $form->date('purchased');
            $form->date('expired');
            $form->select('distribution')
                ->options(Data::distribution())
                ->default('u')
                ->required();
            $form->display('created_at');
            $form->display('updated_at');
        });
    }
}
