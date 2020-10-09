<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\DeviceCounts;
use App\Admin\Metrics\HardwareCounts;
use App\Admin\Metrics\ServiceCounts;
use App\Admin\Metrics\ServiceIssueCounts;
use App\Admin\Metrics\SoftwareCounts;
use App\Admin\Metrics\StaffCounts;
use App\Admin\Metrics\WebSSHStatus;
use App\Http\Controllers\Controller;
use App\Libraries\System;
use App\Libraries\Track;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Card;

class HomeController extends Controller
{
    public function index(Content $content)
    {
        return $content
            ->header('仪表盘')
            ->description('随时掌握你的资源情况')
            ->body(function (Row $row) {
                $row->column(1, new DeviceCounts());
                $row->column(1, new HardwareCounts());
                $row->column(1, new SoftwareCounts());
                $row->column(1, new StaffCounts());
                $row->column(1, new ServiceCounts());
                $row->column(2, new ServiceIssueCounts());
                $row->column(2, new WebSSHStatus());
                $services = Track::getServiceIssueStatus();
                $row->column(12, new Card('服务状态', view('services_dashboard')->with('services', $services)));
            });
    }

    public function test()
    {
        System::checkWebSSHServiceStatus('http://127.0.0.1:8888');
    }
}
