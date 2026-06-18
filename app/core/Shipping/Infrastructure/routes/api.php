<?php

use Illuminate\Support\Facades\Route;
use Core\Shipping\Http\Controllers\ShippingController;
use Core\Shipping\Http\Controllers\ViewController;

Route::prefix('/api/business-access')->middleware(['business'])->group(function () {
    Route::resource('/shippings', ShippingController::class);
    Route::get('/view/shippings', [ViewController::class,'index']);
});