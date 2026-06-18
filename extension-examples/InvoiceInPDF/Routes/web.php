<?php

use Extensions\InvoiceInPDF\Http\Controllers\InvoiceInPDFController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])
    ->prefix('extensions/invoice-pdf')
    ->group(function () {
        //
        Route::get('/',function(){
            return "Not found";
        })->name('InvoiceInPDF');
        Route::get('/{invoiceId}',[InvoiceInPDFController::class,'show'])->name('InvoiceInPDF.show');
    });
