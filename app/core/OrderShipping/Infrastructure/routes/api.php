<?php

use Illuminate\Support\Facades\Route;
use Core\OrderShipping\Http\Controllers\OrderShippingController;
use Core\OrderShipping\Http\Controllers\ViewOrderShippingController;

Route::prefix('/api/business-access')->middleware(['business'])->group(function () {
    Route::resource('/order-shippings', OrderShippingController::class);
    Route::get('/view/order-shippings',[ViewOrderShippingController::class,'index']);
});