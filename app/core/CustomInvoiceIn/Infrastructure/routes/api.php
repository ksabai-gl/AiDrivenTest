<?php

use Illuminate\Support\Facades\Route;
use Core\CustomInvoiceIn\Http\Controllers\CustomInvoiceInController;
use Core\CustomInvoiceIn\Http\Controllers\ViewCustomInvoiceInController;

Route::prefix('/api/business-access')
    ->middleware(['business'])->group(function () {
    Route::resource('/custom-invoice-ins', CustomInvoiceInController::class);
    Route::get('/view/custom-invoice-ins', [ViewCustomInvoiceInController::class,'index']);
});