<?php


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InfoController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('refresh', [AuthController::class, 'refresh']);
    Route::post('me', [AuthController::class, 'me']);
});

Route::get('info/{item_id}', [InfoController::class, 'info']);
Route::get('check/{string}', [InfoController::class, 'check']);
Route::post('check/do', [InfoController::class, 'checkDo']);

Route::get('check/{string}', [InfoController::class, 'check']);

Route::get('phpinfo', function () {
    return phpinfo();
});

Route::get('test', function () {

});
