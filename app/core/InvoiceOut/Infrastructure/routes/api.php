<?php

use Illuminate\Support\Facades\Route;
use Core\InvoiceOut\Http\Controllers\InvoiceOutController;
use Core\InvoiceOut\Http\Controllers\ViewInvoiceOutController;

Route::prefix('api/business-access')->middleware(['business'])->group(function () {
    Route::resource('/invoice-outs', InvoiceOutController::class);
    Route::get('/view/invoice-outs',[ViewInvoiceOutController::class,'index']);
});