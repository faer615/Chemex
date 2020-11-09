<?php

use Celaraze\DcatAdminMenuSwitch\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('dcatadmin-menu-switch', Controllers\DcatadminMenuSwitchController::class.'@index');