<?php

namespace App\Admin\Controllers;

use App\Admin\Metrics\AllWorth;
use App\Admin\Metrics\CheckDevicePercentage;
use App\Admin\Metrics\CheckHardwarePercentage;
use App\Admin\Metrics\CheckSoftwarePercentage;
use App\Admin\Metrics\DeviceAboutToExpireCounts;
use App\Admin\Metrics\DeviceCounts;
use App\Admin\Metrics\DeviceExpiredCounts;
use App\Admin\Metrics\DeviceWorth;
use App\Admin\Metrics\HardwareAboutToExpireCounts;
use App\Admin\Metrics\HardwareCounts;
use App\Admin\Metrics\HardwareExpiredCounts;
use App\Admin\Metrics\HardwareWorth;
use App\Admin\Metrics\IssueTrend;
use App\Admin\Metrics\MaintenanceTrend;
use App\Admin\Metrics\ServiceCounts;
use App\Admin\Metrics\ServiceIssueCounts;
use App\Admin\Metrics\SoftwareAboutToExpireCounts;
use App\Admin\Metrics\SoftwareCounts;
use App\Admin\Metrics\SoftwareExpiredCounts;
use App\Admin\Metrics\SoftwareWorth;
use App\Admin\Metrics\StaffCounts;
use App\Admin\Metrics\WorthTrend;
use App\Http\Controllers\Controller;
use App\Models\AdminUser;
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
                $row->column(10, function (Column $column) {
                    $column->row(function (Row $row) {
                        $row->column(3, function (Column $column) {
                            $user = AdminUser::where('id', auth('admin')->id())->first();
                            $notifications = $user->notifications;
                            $notifications = json_decode($notifications, true);
                            $column->row(new Card('我的待办', view('todo')->with('notifications', $notifications)));
                            $column->row(new WorthTrend());
                            $column->row(new MaintenanceTrend());
                            $column->row(new IssueTrend());
                        });
                        $row->column(9, function (Column $column) {
                            $services = Track::getServiceIssueStatus();
                            $column->row(new Card('服务程序状态', view('services_dashboard')->with('services', $services)));
                            $column->row(function (Row $row) {
                                $row->column(3, new AllWorth());
                                $row->column(3, new DeviceWorth());
                                $row->column(3, new HardwareWorth());
                                $row->column(3, new SoftwareWorth());
                                $row->column(3, new DeviceCounts());
                                $row->column(3, new HardwareCounts());
                                $row->column(3, new SoftwareCounts());
                                $row->column(3, new StaffCounts());
                                $row->column(3, new ServiceCounts());
                                $row->column(3, new ServiceIssueCounts());
                            });
                        });
                    });
                });
                $row->column(2, function (Column $column) {
                    $column->row(new CheckDevicePercentage());
                    $column->row(new CheckHardwarePercentage());
                    $column->row(new CheckSoftwarePercentage());
                    $column->row(new DeviceAboutToExpireCounts());
                    $column->row(new HardwareAboutToExpireCounts());
                    $column->row(new SoftwareAboutToExpireCounts());
                    $column->row(new DeviceExpiredCounts());
                    $column->row(new HardwareExpiredCounts());
                    $column->row(new SoftwareExpiredCounts());
                });
            });
    }
}
