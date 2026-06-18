<?php

use Illuminate\Support\Facades\Route;
use Core\InvoiceIn\Http\Controllers\InvoiceInController;
use Core\InvoiceIn\Http\Controllers\ViewInvoiceInController;

Route::prefix('/api/business-access')->middleware(['business'])->group(function () {
    Route::resource('/invoice-ins', InvoiceInController::class);
    Route::get('/view/invoice-ins',[ViewInvoiceInController::class,'index']);
});