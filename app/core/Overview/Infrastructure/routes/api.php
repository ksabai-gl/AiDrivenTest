<?php

use Illuminate\Support\Facades\Route;
use Core\Overview\Http\Controllers\OverviewController;

Route::prefix('/api/business-access')
    ->middleware(['business'])
    ->group(function () {
    Route::get('/overviews', [OverviewController::class,'index'])->name('Overview.index');
});