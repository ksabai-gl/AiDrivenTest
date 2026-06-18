<?php

use Illuminate\Support\Facades\Route;
use Core\CustomInvoiceOut\Http\Controllers\CustomInvoiceOutController;
use Core\CustomInvoiceOut\Http\Controllers\ViewCustomInvoiceOutController;

Route::prefix('/api/business-access')->middleware(['business'])->group(function () {
    Route::resource('/custom-invoice-outs', CustomInvoiceOutController::class);
    Route::get('/view/custom-invoice-outs', [ViewCustomInvoiceOutController::class,'index']);
});