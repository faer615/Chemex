<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\DeviceCounts;
use App\Admin\Metrics\HardwareCounts;
use App\Admin\Metrics\SoftwareCounts;
use App\Admin\Metrics\StaffCounts;
use App\Http\Controllers\Controller;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('仪表盘')
            ->description('随时掌握你的资源情况')
            ->body(function (Row $row) {
                $row->column(3, new DeviceCounts());
                $row->column(3, new HardwareCounts());
                $row->column(3, new SoftwareCounts());
                $row->column(3, new StaffCounts());
            });
    }
}
