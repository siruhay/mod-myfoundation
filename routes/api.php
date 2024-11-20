<?php

use Illuminate\Support\Facades\Route;
use Module\MyFoundation\Http\Controllers\DashboardController;


Route::get('dashboard', [DashboardController::class, 'index']);