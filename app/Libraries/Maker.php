<?php


namespace App\Libraries;


use App\Models\Department;
use App\Models\Dimension;
use App\Models\Dimension_Tracking;
use App\Models\Skill;
use App\Models\Skill_Class;
use App\Models\Skill_Tracking;
use App\Models\User;
use Chemex\Plus\LaravelAdmin;

class Maker
{
    /**
     * 选择技能分类
     * @return array
     */
    static function selectSkillClasses()
    {
        $skill_classes = Skill_Class::where('status', 1)->get(['id', 'name']);
        $skill_classes = LaravelAdmin::collectionToArray($skill_classes, 'id', 'name');
        return $skill_classes;
    }

    /**
     * 选择用户
     * @return array
     */
    static function selectUsers()
    {
        $users = User::where('status', 1)->get(['id', 'name']);
        $users = LaravelAdmin::collectionToArray($users, 'id', 'name');
        return $users;
    }

    /**
     * 选择部门
     * @return array
     */
    static function selectDepartments()
    {
        $departments = Department::where('status', 1)->get(['id', 'name']);
        $departments = LaravelAdmin::collectionToArray($departments, 'id', 'name');
        return $departments;
    }

    /**
     * 选择技能
     * @return array
     */
    static function selectSkills()
    {
        $skills = Skill::where('status', 1)->get(['id', 'name']);
        $skills = LaravelAdmin::collectionToArray($skills, 'id', 'name');
        return $skills;
    }

    /**
     * 选择维度
     * @return array
     */
    static function selectDimensions()
    {
        $dimensions = Dimension::where('status', 1)->get(['id', 'name']);
        $dimensions = LaravelAdmin::collectionToArray($dimensions, 'id', 'name');
        return $dimensions;
    }

    /**
     * 用户ID交换用户名称
     * @param $id
     * @return string
     */
    static function getUserNameById($id)
    {
        $user = User::find($id);
        if (empty($user)) {
            return '未知';
        } else {
            return $user->name;
        }
    }

    /**
     * 技能ID交换技能名称
     * @param $id
     * @return string
     */
    static function getSkillNameById($id)
    {
        $skill = Skill::find($id);
        if (empty($skill)) {
            return '未知';
        } else {
            return $skill->name;
        }
    }

    /**
     * 部门ID交换部门名称
     * @param $id
     * @return string
     */
    static function getDepartmentNameById($id)
    {
        $department = Department::find($id);
        if (empty($department)) {
            return '未知';
        } else {
            return $department->name;
        }
    }

    /**
     * 用户ID交换部门名称
     * @param $id
     * @return string
     */
    static function getDepartmentNameByUserId($id)
    {
        $user = User::find($id);
        if (!empty($user)) {
            $department_id = $user->department_id;
            $department = Department::find($department_id);
            if (!empty($department)) {
                return $department->name;
            } else {
                return '未知';
            }
        } else {
            return '未知';
        }
    }

    /**
     * 绘制技能条的前端标签
     * @param $level
     * @return string
     */
    static function drawLevelBar($level)
    {
        $percent = ($level * 10) . '%';
        if ($level > 0 && $level <= 3) {
            $color = '183,28,28,0.7';
            $text = '入门';
        } elseif ($level > 3 && $level <= 6) {
            $color = '230,81,0,0.7';
            $text = '熟练';
        } elseif ($level > 6 && $level <= 9) {
            $color = '51,105,30,0.7';
            $text = '精通';
        } elseif ($level == 10) {
            $color = '13,71,161,0.7';
            $text = '专家';
        } else {
            $color = '0,0,0,0.7';
            $text = '不会';
        }
        $bar = "<div style='width:100%;height:18px;background-color:rgba(0,0,0,0.2);'>";
        $bar .= "<div style='height:18px;width:$percent;background-color:rgba($color);padding-left:4px;font-size:8px;color:white;'>$level</div>";
        $bar .= "</div>";
        return $bar;
    }

    /**
     * 获取某个人的维度
     * @param $user_id
     * @return array
     */
    static function getUserDetail($user_id)
    {
        $detail = [];
        $dimensions = Dimension::where('status', 1)->get();
        foreach ($dimensions as $key => $dimension) {
            $dt = Dimension_Tracking::where('user_id', $user_id)->where('dimension_id', $dimension->id)->orderBy('updated_at', 'DESC')->first();
            $detail[$key]['name'] = $dimension->name;
            if (empty($dt)) {
                $detail[$key]['value'] = 0;
            } else {
                $detail[$key]['value'] = $dt->level;
            }
        }
        return $detail;
    }

    /**
     * 获取某个人的维度全部追踪
     * @param $user_id
     * @return array
     */
    static function getUserDimensionTracking($user_id)
    {
        $trackings = [];
        $dimensions = Dimension::where('status', 1)->get();
        foreach ($dimensions as $key => $dimension) {
            $dts = Dimension_Tracking::where('user_id', $user_id)->where('dimension_id', $dimension->id)->orderBy('updated_at', 'ASC')->get();
            $trackings[$key]['name'] = $dimension->name;
            $trackings[$key]['color'] = $dimension->color;
            $trackings[$key]['value'] = [];
            foreach ($dts as $dt_key => $dt) {
                array_push($trackings[$key]['value'], $dt->level);
            }
        }
        return $trackings;
    }

    /**
     * 获取某员工掌握的所有技能和等级
     * @param $user_id
     * @return array
     */
    static function getUserSkills($user_id)
    {
        $skills = [];
        $sts = Skill_Tracking::where('user_id', $user_id)->get();
        foreach ($sts as $key => $st) {
            $skill = Skill::where('id', $st->skill_id)->where('status', 1)->first();
            if (empty($skill)) {
                $single['name'] = '未知技能';
                $single['level'] = 0;
            } else {
                $single['name'] = $skill->name;
                $single['value'] = $st->level;
            }
            array_push($skills, $single);
        }
        return $skills;
    }
}
