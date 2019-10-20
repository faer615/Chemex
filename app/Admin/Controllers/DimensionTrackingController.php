<?php

namespace App\Admin\Controllers;

use App\Models\Dimension_Tracking;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Show;
use James\Admin\Grid;

class DimensionTrackingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '员工维度追踪';
    protected $users_api = '/admin/selection/users';
    protected $dimensions_api = '/admin/selection/dimensions';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Dimension_Tracking);

        $grid->filter(function ($filter) {
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->equal('user_id', '员工名称')->select($this->users_api);
            $filter->equal('dimension_id', '维度名称')->select($this->dimensions_api);
        });

        $grid->column('id', __('ID'));
        $grid->column('user.name', __('用户'));
        $grid->column('dimension.name', __('维度'));
        $grid->column('level', __('等级'));
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
        $show = new Show(Dimension_Tracking::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('user_id', __('用户'));
        $show->field('dimension_id', __('维度'));
        $show->field('level', __('等级'));
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
        $form = new Form(new Dimension_Tracking);

        $form->select('user_id', __('用户'))->options($this->users_api);
        $form->select('dimension_id', __('维度'))->options($this->dimensions_api);
        $form->number('level', __('等级'))->min(0)->max(10)->default(0);

        return $form;
    }
}
