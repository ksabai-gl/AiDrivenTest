<?php

use Extensions\Hrm\Http\Controllers\HrmController;
use Illuminate\Support\Facades\Route;

Route::middleware(['signed'])->group(function () {
        Route::get('/download',[HrmController::class,'download'])
            ->name('extension.hrm.download');
    });