<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\BatchAction\StaffRecordBatchDeleteAction;
use App\Admin\Actions\Grid\RowAction\StaffRecordDeleteAction;
use App\Admin\Actions\Grid\ToolAction\StaffRecordImportAction;
use App\Admin\Grid\Displayers\RowActions;
use App\Admin\Repositories\StaffRecord;
use App\Models\StaffDepartment;
use App\Support\Data;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Show;

/**
 * @property int ad_tag
 */
class StaffRecordController extends AdminController
{
    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        return Grid::make(new StaffRecord(['department']), function (Grid $grid) {
            $grid->column('id');
            $grid->column('name')->display(function ($name) {
                if ($this->ad_tag === 1) {
                    return "<span class='badge badge-primary mr-1'>AD</span>$name";
                }
                return $name;
            });
            $grid->column('department.name');
            $grid->column('gender');
            $grid->column('title');
            $grid->column('mobile');
            $grid->column('email');

            $grid->enableDialogCreate();
            $grid->disableDeleteButton();
            $grid->disableBatchDelete();

            $grid->batchActions([
                new StaffRecordBatchDeleteAction()
            ]);

            $grid->actions(function (RowActions $actions) {
                if (Admin::user()->can('staff.record.delete')) {
                    $actions->append(new StaffRecordDeleteAction());
                }
            });

            $grid->toolsWithOutline(false);

            $grid->tools([
                new StaffRecordImportAction()
            ]);

            $grid->quickSearch('id', 'name', 'department.name', 'gender', 'title', 'mobile', 'email')
                ->placeholder('试着搜索一下')
                ->auto(false);

            $grid->export();
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
        return Show::make($id, new StaffRecord(['department']), function (Show $show) {
            $show->field('id');
            $show->field('name')->unescape()->as(function ($name) {
                if ($this->ad_tag === 1) {
                    return "<span class='badge badge-primary mr-1'>AD</span>$name";
                }
                return $name;
            });
            $show->field('department.name');
            $show->field('gender');
            $show->field('title');
            $show->field('mobile');
            $show->field('email');
            $show->field('created_at');
            $show->field('updated_at');

            $show->disableDeleteButton();
        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        return Form::make(new StaffRecord(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->select('department_id', admin_trans_label('Department'))
                ->options(StaffDepartment::selectOptions())
                ->required();
            $form->select('gender')
                ->options(Data::genders())
                ->required();
            $form->text('title');
            $form->mobile('mobile');
            $form->email('email');

            $form->display('created_at');
            $form->display('updated_at');

            $form->disableDeleteButton();

            $form->disableCreatingCheck();
            $form->disableEditingCheck();
            $form->disableViewCheck();
        });
    }
}
