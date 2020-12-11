<?php

namespace App\Admin\Controllers;

use App\Admin\Repositories\HardwareCategory;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

class HardwareCategoryController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        return Grid::make(new HardwareCategory(), function (Grid $grid) {
            $grid->column('id');
            $grid->column('name');
            $grid->column('description');

            $grid->enableDialogCreate();

            $grid->toolsWithOutline(false);

            $grid->quickSearch('id', 'name', 'description')
                ->placeholder('试着搜索一下')
                ->auto(false);
        });
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     *
     * @return Show
     */
    protected function detail($id): Show
    {
        return Show::make($id, new HardwareCategory(), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('description');
            $show->field('created_at');
            $show->field('updated_at');
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        return Form::make(new HardwareCategory(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->text('description');
            $form->display('created_at');
            $form->display('updated_at');

            $form->disableCreatingCheck();
            $form->disableEditingCheck();
            $form->disableViewCheck();
        });
    }
}
