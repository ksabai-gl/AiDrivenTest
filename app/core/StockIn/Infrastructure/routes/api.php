<?php

use Illuminate\Support\Facades\Route;
use Core\StockIn\Http\Controllers\StockInController;
use Core\StockIn\Http\Controllers\ViewStockInController;

Route::prefix('/api/business-access/stocks')->middleware(['business'])->group(function () {
    Route::resource('/ins', StockInController::class);
    Route::get('/view/ins',[ViewStockInController::class,'index']);
});