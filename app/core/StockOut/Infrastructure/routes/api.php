<?php

use Illuminate\Support\Facades\Route;
use Core\StockOut\Http\Controllers\StockOutController;
use Core\StockOut\Http\Controllers\ViewStockOutController;

Route::prefix('/api/business-access/stocks')->middleware(['business'])->group(function () {
    Route::resource('/outs', StockOutController::class);
    Route::get('/view/outs', [ViewStockOutController::class,'index']);
});