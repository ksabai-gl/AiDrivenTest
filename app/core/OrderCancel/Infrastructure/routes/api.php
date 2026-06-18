<?php

use Illuminate\Support\Facades\Route;
use Core\OrderCancel\Http\Controllers\CreateOrderCancelController;

Route::prefix(strtolower('OrderCancels'))->group(function () {
    Route::post('/', CreateOrderCancelController::class)->name('OrderCancel.create');
});