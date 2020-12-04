<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\CheckDevicePercentage;
use App\Admin\Metrics\CheckHardwarePercentage;
use App\Admin\Metrics\CheckSoftwarePercentage;
use App\Admin\Metrics\DeviceCounts;
use App\Admin\Metrics\HardwareCounts;
use App\Admin\Metrics\ServiceCounts;
use App\Admin\Metrics\ServiceIssueCounts;
use App\Admin\Metrics\SoftwareCounts;
use App\Admin\Metrics\StaffCounts;
use App\Http\Controllers\Controller;
use App\Support\Track;
use Dcat\Admin\Layout\Column;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Layout\Row;
use Dcat\Admin\Widgets\Card;

class HomeController extends Controller
{
    public function index(Content $content): Content
    {
        return $content
            ->header('仪表盘')
            ->description('随时掌握你的资源情况')
            ->body(function (Row $row) {
                $row->column(2, function (Column $column) {
                    $column->row(new DeviceCounts());
                    $column->row(new HardwareCounts());
                    $column->row(new SoftwareCounts());
                    $column->row(new StaffCounts());
                    $column->row(new ServiceCounts());
                    $column->row(new ServiceIssueCounts());
                });
                $row->column(10, function (Column $column) {
                    $column->row(function (Row $row) {
                        $row->column(4, new CheckDevicePercentage());
                        $row->column(4, new CheckHardwarePercentage());
                        $row->column(4, new CheckSoftwarePercentage());
                    });
                    $services = Track::getServiceIssueStatus();
                    $column->row(new Card(view('services_dashboard')->with('services', $services)));
                });
            });
    }
}
