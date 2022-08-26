<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('count', [\App\Http\Controllers\LogController::class, 'counter']);
