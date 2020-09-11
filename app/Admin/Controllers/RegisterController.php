<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Dcat\Admin\Layout\Content;

class RegisterController extends Controller
{
    public function getRegister(Content $content)
    {
        return $content->full()->body(view('register'));
    }
}
