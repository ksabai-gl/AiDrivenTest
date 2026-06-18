<?php

use Illuminate\Support\Facades\Route;
use Core\StockMovementOut\Http\Controllers\StockMovementOutController;

Route::prefix('/api/business-access')
    ->middleware(['business'])->group(function () {
    Route::resource('stock-movement-outs', StockMovementOutController::class);
});
