<?php

use Illuminate\Support\Facades\Route;
use Core\PriceList\Http\Controllers\PriceListController;
use Core\PriceList\Http\Controllers\ViewPriceListController;

Route::prefix('/api/business-access')->middleware(['business'])->group(function () {
    Route::resource('/price-lists', PriceListController::class);
    Route::get('/view/price-lists',[ViewPriceListController::class,'index']);
});