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
    $router->get('/version', 'VersionController@index');
    $router->get('/version/migrate', 'VersionController@migrate')
        ->name('migrate');
    $router->get('/version/clear', 'VersionController@clear')
        ->name('clear');
    $router->get('/tools/chemex_qrcode_generator', 'QrCodeGeneratorController@index')
        ->name('chemex_qrcode_generator');
    $router->get('/test', 'HomeController@test');
    $router->resource('/device/tracks', 'DeviceTrackController');
    $router->resource('/device/records', 'DeviceRecordController', ['names' => [
        'index' => 'device.records.index',
        'show' => 'device.records.show'
    ]]);
    $router->resource('/device/categories', 'DeviceCategoryController');
    $router->resource('/software/records', 'SoftwareRecordController', ['names' => [
        'index' => 'software.records.index',
        'show' => 'software.records.show'
    ]]);
    $router->resource('/software/tracks', 'SoftwareTrackController', ['names' => [
        'index' => 'software.tracks.index'
    ]]);
    $router->resource('/software/categories', 'SoftwareCategoryController');
    $router->resource('/hardware/records', 'HardwareRecordController', ['names' => [
        'index' => 'hardware.records.index',
        'show' => 'hardware.records.show'
    ]]);
    $router->resource('/hardware/tracks', 'HardwareTrackController');
    $router->resource('/hardware/categories', 'HardwareCategoryController');
    $router->resource('/vendor/records', 'VendorRecordController');
    $router->resource('/purchased/channels', 'PurchasedChannelController');
    $router->resource('/staff/records', 'StaffRecordController', ['names' => [
        'index' => 'staff.records.index'
    ]]);
    $router->resource('/staff/departments', 'StaffDepartmentController');
    $router->resource('/check/records', 'CheckRecordController', ['names' => [
        'index' => 'check.records.index',
        'show' => 'check.records.show'
    ]]);
    $router->resource('/check/tracks', 'CheckTrackController');
    $router->resource('/service/records', 'ServiceRecordController', ['names' => [
        'index' => 'service.records.index',
        'show' => 'service.records.show'
    ]]);
    $router->resource('/service/issues', 'ServiceIssueController', ['names' => [
        'index' => 'service.issues.index'
    ]]);
    $router->resource('/service/tracks', 'ServiceTrackController');
    $router->resource('/maintenance/records', 'MaintenanceRecordController');
    $router->resource('/depreciation/rules', 'DepreciationRuleController');
    $router->resource('/chart/records', 'ChartRecordController');

    $router->get('/export/device/{device_id}/history', [DeviceRecordController::class, 'exportHistory'])
        ->name('export.device.history');
    $router->get('/export/software/{software_id}/history', [SoftwareRecordController::class, 'exportHistory'])
        ->name('export.software.history');

    $router->get('/notifications/read_all', [NotificationController::class, 'readAll'])
        ->name('notification.read.all');
    $router->get('/notifications/read/{id}', [NotificationController::class, 'read'])
        ->name('notification.read');
});
