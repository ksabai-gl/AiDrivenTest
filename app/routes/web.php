<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class,'index'])->name('home');
Route::get('/', [HomeController::class,'index'])->name('login');

Route::prefix('dashboard')->group(function () {
    Route::get('/', 'App\Http\Controllers\FE\DashboardController@index');
    Route::get('/{slug}', 'App\Http\Controllers\FE\DashboardController@index');
});
