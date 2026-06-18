<?php

use Illuminate\Support\Facades\Route;
use Core\StockMovementIn\Http\Controllers\StockMovementInController;

Route::prefix('/api/business-access')->middleware(['business'])->group(function () {
    Route::resource('stock-movement-ins', StockMovementInController::class);
});