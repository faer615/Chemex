<?php

use App\Admin\Controllers\DeviceRecordController;
use App\Admin\Controllers\NotificationController;
use App\Admin\Controllers\SoftwareRecordController;
use Dcat\Admin\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index');

    /**
     * 辅助信息
     */
    $router->get('/version', 'VersionController@index');
    $router->get('/version/migrate', 'VersionController@migrate')
        ->name('migrate');
    $router->get('/version/clear', 'VersionController@clear')
        ->name('clear');
    $router->get('/configurations', 'ConfigurationController@index')
        ->name('configurations.index');

    /**
     * 工具
     */
    $router->get('/tools/qrcode_generator', 'ToolQRCodeGeneratorController@index')
        ->name('qrcode_generator');
    $router->get('/tools/android_app', 'ToolAndroidAppController@index')
        ->name('android_app');

    /**
     * 测试
     */
    $router->get('/test', 'HomeController@test');

    /**
     * 设备管理
     */
    $router->resource('/device/records', 'DeviceRecordController', ['names' => [
        'index' => 'device.records.index',
        'show' => 'device.records.show'
    ]]);
    $router->resource('/device/tracks', 'DeviceTrackController', ['names' => [
        'index' => 'device.tracks.index',
        'show' => 'device.tracks.show'
    ]]);
    $router->resource('/device/categories', 'DeviceCategoryController', ['names' => [
        'index' => 'device.categories.index',
        'show' => 'device.categories.show'
    ]]);

    /**
     * 硬件管理
     */
    $router->resource('/hardware/records', 'HardwareRecordController', ['names' => [
        'index' => 'hardware.records.index',
        'show' => 'hardware.records.show'
    ]]);
    $router->resource('/hardware/tracks', 'HardwareTrackController', ['names' => [
        'index' => 'hardware.tracks.index',
        'show' => 'hardware.tracks.show'
    ]]);
    $router->resource('/hardware/categories', 'HardwareCategoryController', ['names' => [
        'index' => 'hardware.categories.index',
        'show' => 'hardware.categories.show'
    ]]);

    /**
     * 软件管理
     */
    $router->resource('/software/records', 'SoftwareRecordController', ['names' => [
        'index' => 'software.records.index',
        'show' => 'software.records.show'
    ]]);
    $router->resource('/software/categories', 'SoftwareCategoryController', ['names' => [
        'index' => 'software.categories.index',
        'show' => 'software.categories.show'
    ]]);
    $router->resource('/software/tracks', 'SoftwareTrackController', ['names' => [
        'index' => 'software.tracks.index',
        'show' => 'software.tracks.show'
    ]]);

    /**
     * 厂商管理
     */
    $router->resource('/vendor/records', 'VendorRecordController');

    /**
     * 购入途径管理
     */
    $router->resource('/purchased/channels', 'PurchasedChannelController');

    /**
     * 组织管理
     */
    $router->resource('/staff/records', 'StaffRecordController', ['names' => [
        'index' => 'staff.records.index'
    ]]);
    $router->resource('/staff/departments', 'StaffDepartmentController');

    /**
     * 盘点管理
     */
    $router->resource('/check/records', 'CheckRecordController', ['names' => [
        'index' => 'check.records.index',
        'show' => 'check.records.show'
    ]]);
    $router->resource('/check/tracks', 'CheckTrackController');

    /**
     * 服务管理
     */
    $router->resource('/service/records', 'ServiceRecordController', ['names' => [
        'index' => 'service.records.index',
        'show' => 'service.records.show'
    ]]);
    $router->resource('/service/issues', 'ServiceIssueController', ['names' => [
        'index' => 'service.issues.index'
    ]]);
    $router->resource('/service/tracks', 'ServiceTrackController');

    /**
     * 故障维护
     */
    $router->resource('/maintenance/records', 'MaintenanceRecordController');

    /**
     * 折旧规则
     */
    $router->resource('/depreciation/rules', 'DepreciationRuleController');

    /**
     * 图表管理 TODO
     */
    $router->resource('/chart/records', 'ChartRecordController');

    /**
     * 导出
     */
    $router->get('/export/device/{device_id}/history', [DeviceRecordController::class, 'exportHistory'])
        ->name('export.device.history');
    $router->get('/export/software/{software_id}/history', [SoftwareRecordController::class, 'exportHistory'])
        ->name('export.software.history');

    /**
     * 通知
     */
    $router->get('/notifications/read_all', [NotificationController::class, 'readAll'])
        ->name('notification.read.all');
    $router->get('/notifications/read/{id}', [NotificationController::class, 'read'])
        ->name('notification.read');
});
