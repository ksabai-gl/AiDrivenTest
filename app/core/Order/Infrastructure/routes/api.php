<?php

use Illuminate\Support\Facades\Route;
use Core\Order\Http\Controllers\OrderController;
use Core\Order\Http\Controllers\ViewOrderController;

Route::prefix('/api/business-access')->middleware(['business'])->group(function () {
    Route::resource('/orders', OrderController::class);
    Route::get('/view/orders', [ViewOrderController::class,'index']);
});