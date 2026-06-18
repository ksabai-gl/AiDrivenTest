<?php

use Illuminate\Support\Facades\Route;
use Core\Notifications\Http\Controllers\NotificationController;

Route::prefix('/api/business-access')->middleware(['business'])->group(function () {
    Route::resource('/notifications', NotificationController::class);
});