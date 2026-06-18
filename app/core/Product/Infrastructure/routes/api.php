<?php

use Illuminate\Support\Facades\Route;
use Core\Product\Http\Controllers\ProductController;
use Core\Product\Http\Controllers\ViewProductController;

Route::prefix('/api/business-access')->middleware(['business'])->group(function () {
    Route::resource('/products', ProductController::class);
    Route::get('/view/products', [ViewProductController::class,'index']);
});