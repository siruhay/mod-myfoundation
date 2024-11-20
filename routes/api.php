<?php

use Illuminate\Support\Facades\Route;
use Module\MyFoundation\Http\Controllers\DashboardController;
use Module\MyFoundation\Http\Controllers\MyFoundationOfficialController;
use Module\MyFoundation\Http\Controllers\MyFoundationCommunityController;

Route::get('dashboard', [DashboardController::class, 'index']);
Route::get('report', [DashboardController::class, 'report']);
Route::resource('community', MyFoundationCommunityController::class)->parameters(['community' => 'myFoundationCommunity']);
Route::resource('official', MyFoundationOfficialController::class)->parameters(['official' => 'myFoundationCommunity']);
