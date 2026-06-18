<?php

use Illuminate\Support\Facades\Route;
use Core\PurchaseTax\Http\Controllers\PurchaseTaxController;

Route::prefix('api/business-access')->middleware(['business'])->group(function () {
    Route::resource('/purchase-taxs', PurchaseTaxController::class);
});