<?php

use Celaraze\ChemexObserverMessage\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('chemex-observer-message', Controllers\ChemexObserverMessageController::class.'@index');