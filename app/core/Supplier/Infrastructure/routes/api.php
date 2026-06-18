<?php

use Illuminate\Support\Facades\Route;
use Core\Supplier\Http\Controllers\SupplierController;
use Core\Supplier\Http\Controllers\ViewSupplierController;

Route::prefix('/api/business-access')->middleware(['business'])->group(function () {
    Route::resource('/suppliers', SupplierController::class);
    Route::get('/view/suppliers', [ViewSupplierController::class,'index']);
});