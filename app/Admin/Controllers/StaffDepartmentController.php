<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Grid\ToolAction\StaffDepartmentImportAction;
use App\Admin\Repositories\StaffDepartment;
use Dcat\Admin\Form;
use Dcat\Admin\Grid;
use Dcat\Admin\Http\Controllers\AdminController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Show;
use Dcat\Admin\Tree;

class StaffDepartmentController extends AdminController
{

    public function index(Content $content)
    {
        return $content
            ->title($this->title())
            ->description(trans('admin.list'))
            ->body(function (Row $row) {
                $tree = new Tree(new \App\Models\StaffDepartment());
                $row->column(12, $tree);
            });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        return Grid::make(new StaffDepartment(['parent']), function (Grid $grid) {
            $grid->column('id');
            $grid->column('name');
            $grid->column('description');
            $grid->column('parent.name');

            $grid->enableDialogCreate();

            $grid->toolsWithOutline(false);

            $grid->tools([
                new StaffDepartmentImportAction()
            ]);

            $grid->quickSearch('id', 'name', 'description', 'parent.name');
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
        return Show::make($id, new StaffDepartment(['parent']), function (Show $show) {
            $show->field('id');
            $show->field('name');
            $show->field('description');
            $show->field('parent.name');
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
        return Form::make(new StaffDepartment(), function (Form $form) {
            $form->display('id');
            $form->text('name')->required();
            $form->text('description');
            $form->select('parent_id', admin_trans_label('Parent'))
                ->options(\App\Models\StaffDepartment::all()
                    ->pluck('name', 'id'))
                ->default(0);

            $form->display('created_at');
            $form->display('updated_at');

            $form->disableCreatingCheck();
            $form->disableEditingCheck();
            $form->disableViewCheck();
        });
    }
}
