<?php

use Encore\Admin\Facades\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('admin.home');
    $router->resource('users', 'UserController');
    $router->resource('departments', 'DepartmentController');
    $router->resource('skills', 'SkillController');
    $router->resource('skill_classes', 'SkillClassController');
    $router->resource('skill_tracking', 'SkillTrackingController');
    $router->resource('dimensions', 'DimensionController');
    $router->resource('dimension_tracking', 'DimensionTrackingController');

    //选择
    Route::prefix('selection')->group(function () {
        Route::get('skill_classes', 'SelectionController@selectSkillClasses');
        Route::get('skills', 'SelectionController@selectSkills');
        Route::get('users', 'SelectionController@selectUsers');
        Route::get('departments', 'SelectionController@selectDepartments');
        Route::get('dimensions', 'SelectionController@selectDimensions');
    });

    //API
    Route::get('api/user_detail/{user_id}', 'ApiController@getUserDetail');

});
