<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('首页')
            ->description('仪表盘')
            ->view('dashboard', ['data' => 123]);
    }
}
