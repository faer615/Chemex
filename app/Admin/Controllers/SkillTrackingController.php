<?php

namespace App\Admin\Controllers;

use App\Libraries\Maker;
use App\Models\Skill_Tracking;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Show;
use James\Admin\Grid;

class SkillTrackingController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '技能追踪';
    protected $skills_api = '/admin/selection/skills';
    protected $users_api = '/admin/selection/users';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Skill_Tracking);

        $grid->filter(function ($filter) {
            // 去掉默认的id过滤器
            $filter->disableIdFilter();
            // 在这里添加字段过滤器
            $filter->equal('user_id', '员工名称')->select($this->users_api);
            $filter->equal('skill_id', '技能名称')->select($this->skills_api);
        });

        $grid->column('id', __('ID'));
        $grid->column('user.name', __('用户'));
        $grid->column('', __('部门'))->display(function () {
            return Maker::getDepartmentNameByUserId($this->user_id);
        });
        $grid->column('skill.name', __('技能'));
        $grid->column('level', __('等级'))->display(function ($level) {
            return Maker::drawLevelBar($level);
        });
        // $grid->column('level', __('等级'))->progressBar($style = 'primary', $size = 'sm', $max = 10);
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
        $show = new Show(Skill_Tracking::findOrFail($id));

        $show->field('id', __('ID'));
        $show->field('user_id', __('用户'))->as(function ($user_id) {
            return Maker::getUserNameById($user_id);
        });
        $show->field('skill_id', __('技能'))->as(function ($skill_id) {
            return Maker::getSkillNameById($skill_id);
        });
        $show->field('level', __('等级'));
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
        $form = new Form(new Skill_Tracking);

        $form->select('user_id', __('用户'))->options($this->users_api);
        $form->select('skill_id', __('技能'))->options($this->skills_api);
        $form->number('level', __('等级'))->min(1)->max(10)->default(1);
        $form->textarea('description', __('描述'));

        return $form;
    }
}
