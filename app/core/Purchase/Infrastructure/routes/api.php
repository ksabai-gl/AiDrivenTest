<?php

use Illuminate\Support\Facades\Route;
use Core\Purchase\Http\Controllers\PurchaseController;
use Core\Purchase\Http\Controllers\ViewPurchaseController;

Route::prefix('/api/business-access')->middleware(['business'])->group(function () {
    Route::resource('/purchases', PurchaseController::class);
    Route::get('/view/purchases', [ViewPurchaseController::class,'index']);
});