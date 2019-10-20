<?php

namespace App\Admin\Controllers;

use App\Models\Skill_Class;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Show;
use James\Admin\Grid;

class SkillClassController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '技能分类';
    protected $status = [
        'on' => ['value' => 1, 'text' => '正常', 'color' => 'primary'],
        'off' => ['value' => 0, 'text' => '冻结', 'color' => 'warning'],
    ];

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Skill_Class);

        $grid->filter(function ($filter) {
            // 在这里添加字段过滤器
            $filter->equal('status', '状态')->select([1 => '正常', 0 => '冻结']);
        });

        $grid->column('id', __('ID'));
        $grid->column('name', __('名称'));
        $grid->column('status', __('状态'))->switch($this->status);
        $grid->column('description', __('描述'));
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Skill_Class::findOrFail($id));
        $show->field('id', __('ID'));
        $show->field('name', __('名称'));
        $show->field('status', __('状态'))->using([0 => '冻结', 1 => '正常']);
        $show->field('description', __('描述'));
        $show->field('created_at', __('创建时间'));
        $show->field('updated_at', __('更新时间'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Skill_Class);

        $form->text('name', __('名称'));
        $form->textarea('description', __('描述'));
        $form->switch('status', __('状态'))->states($this->status)->default(1);

        return $form;
    }
}
