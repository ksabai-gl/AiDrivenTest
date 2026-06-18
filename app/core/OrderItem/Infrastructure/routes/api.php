<?php

use Illuminate\Support\Facades\Route;
use Core\OrderItem\Http\Controllers\OrderItemController;

Route::prefix('/api/business-access')
    ->middleware(['business'])
    ->group(function () {
    Route::resource('/orderitems', OrderItemController::class);
});