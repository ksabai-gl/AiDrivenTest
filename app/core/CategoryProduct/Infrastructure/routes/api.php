<?php

use Illuminate\Support\Facades\Route;
use Core\CategoryProduct\Http\Controllers\CategoryProductController;
use Core\CategoryProduct\Http\Controllers\CategoryProductViewController;

Route::prefix('/api/business-access')->middleware(['business'])->group(function () {
    Route::resource('/category-product', CategoryProductController::class);
    Route::get('/view/category-product', [CategoryProductViewController::class,'index']);
});