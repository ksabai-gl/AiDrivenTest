<?php

use Illuminate\Support\Facades\Route;
use Core\ImageManager\Http\Controllers\ImageManagerController;

Route::prefix('/api/business-access')->middleware(['business'])->group(function () {
    Route::resource('/image-manager', ImageManagerController::class);
});