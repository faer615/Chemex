<?php

namespace App\Http\Controllers;

use App\Libraries\Maker;

class SiteController extends Controller
{
    public function test($user_id)
    {
        $return = Maker::getUserSkills($user_id);
        return response()->json($return);
    }
}
