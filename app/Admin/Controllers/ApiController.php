<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Libraries\Maker;
use Illuminate\Http\JsonResponse;

class ApiController extends Controller
{
    /**
     * 获取某个人的维度
     * @param $user_id
     * @return JsonResponse
     */
    public function getUserDetail($user_id)
    {
        $return = Maker::getUserDetail($user_id);
        return response()->json($return);
    }
}
