<?php

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
    $router->resource('/device/tracks', 'DeviceTrackController');
    $router->resource('/device/records', 'DeviceRecordController');
    $router->resource('/device/categories', 'DeviceCategoryController');
    $router->resource('/software/tracks', 'SoftwareTrackController');
    $router->resource('/software/records', 'SoftwareRecordController');
    $router->resource('/software/categories', 'SoftwareCategoryController');
    $router->resource('/hardware/tracks', 'HardwareTrackController');
    $router->resource('/hardware/records', 'HardwareRecordController');
    $router->resource('/hardware/categories', 'HardwareCategoryController');
    $router->resource('/vendor/records', 'VendorRecordController');
    $router->resource('/staff/records', 'StaffRecordController');
    $router->resource('/staff/departments', 'StaffDepartmentController');
    $router->resource('/check/records', 'CheckRecordController');
    $router->resource('/check/tracks', 'CheckTrackController');
});
