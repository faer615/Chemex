<?php

namespace App\Admin\Controllers;

use App\Libraries\Maker;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Box;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '员工';
    protected $departments_api = '/admin/selection/departments';
    protected $sex = [
        '无' => '无',
        '男' => '男',
        '女' => '女'
    ];

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->filter(function ($filter) {
            // 在这里添加字段过滤器
            $filter->like('name', '员工名称');
            $filter->equal('sex', '性别')->select($this->sex);
            $filter->equal('department_id', '部门')->select($this->departments_api);
        });

        $grid->column('id', __('ID'));
        $grid->column('name', __('名称'))->expand(function ($model) {
            $dimensions = Maker::getUserDetail($model->id);
            $trackings = Maker::getUserDimensionTracking($model->id);
            $skills = Maker::getUserSkills($model->id);
            $data['user_id'] = $model->id;
            $data['dimensions'] = $dimensions;
            $data['trackings'] = $trackings;
            $data['skills'] = $skills;
            return new Box(null, view('detail', ['data' => $data]));
        });
        $grid->column('department.name', __('部门'));
        $grid->column('sex', __('性别'));
        // $grid->column('', __('技术标签'))->label();
        $grid->column('cellphone', __('手机'));
        $grid->column('email', __('邮箱地址'));

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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('name', __('名称'));
        $show->field('department_id', __('部门'))->as(function ($department_id) {
            return Maker::getDepartmentNameById($department_id);
        });
        $show->field('sex', __('性别'));
        $show->field('cellphone', __('手机'));
        $show->field('email', __('邮箱地址'));
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
        $form = new Form(new User);

        $form->text('name', __('名称'));
        $form->select('department_id', __('部门'))->options($this->departments_api)->default(0);
        $form->select('sex', __('性别'))->options($this->sex)->default('无');
        $form->text('cellphone', __('手机'));
        $form->email('email', __('邮箱地址'));

        return $form;
    }
}
