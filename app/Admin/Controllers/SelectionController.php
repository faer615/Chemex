<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Libraries\Maker;
use Illuminate\Http\JsonResponse;

class SelectionController extends Controller
{
    /**
     * 选择技能分类
     * @return JsonResponse
     */
    public function selectSkillClasses()
    {
        $return = Maker::selectSkillClasses();
        return response()->json($return);
    }

    /**
     * 选择用户
     * @return JsonResponse
     */
    public function selectUsers()
    {
        $return = Maker::selectUsers();
        return response()->json($return);
    }

    /**
     * 选择部门
     * @return JsonResponse
     */
    public function selectDepartments()
    {
        $return = Maker::selectDepartments();
        return response()->json($return);
    }

    /**
     * 选择技能
     * @return JsonResponse
     */
    public function selectSkills()
    {
        $return = Maker::selectSkills();
        return response()->json($return);
    }

    /**
     * 选择维度
     * @return JsonResponse
     */
    public function selectDimensions()
    {
        $return = Maker::selectDimensions();
        return response()->json($return);
    }
}
