<?php

namespace App\Admin\Controllers;

use App\Models\Dimension;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Show;
use Encore\Admin\Grid;

class DimensionController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '维度';
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
        $grid = new Grid(new Dimension);

        $grid->filter(function ($filter) {
            // 在这里添加字段过滤器
            $filter->equal('status', '状态')->select([1 => '正常', 0 => '冻结']);
        });

        $grid->column('id', __('ID'));
        $grid->column('name', __('名称'));
        $grid->column('color', __('颜色'));
        $grid->column('description', __('描述'));
        $grid->column('status', __('状态'))->switch($this->status);

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
        $show = new Show(Dimension::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('名称'));
        $show->field('color', __('颜色'));
        $show->field('description', __('描述'));
        $show->field('status', __('状态'))->using([0 => '冻结', 1 => '正常']);
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
        $form = new Form(new Dimension);

        $form->text('name', __('名称'));
        $form->text('color', __('颜色(RGB)'));
        $form->text('description', __('描述'));
        $form->switch('status', __('状态'))->options($this->status)->default(1);

        return $form;
    }
}
