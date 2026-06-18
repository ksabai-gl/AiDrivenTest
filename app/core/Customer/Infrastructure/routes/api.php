<?php

use Illuminate\Support\Facades\Route;
use Core\Customer\Http\Controllers\CustomerController;
use Core\Customer\Http\Controllers\ViewController;

Route::prefix('/api/business-access')->middleware(['business'])->group(function () {
    Route::resource('/customers', CustomerController::class);
    Route::get('/view/customers', [ViewController::class,'index']);
});