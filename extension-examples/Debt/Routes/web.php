<?php

use Extensions\Debt\Http\Controllers\DebtController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web','auth'])
    ->prefix('dashboard/debt')
    ->group(function () {
        Route::get('overview',[DebtController::class,'index'])->name('debt.overview');
    });