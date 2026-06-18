<?php

use Illuminate\Support\Facades\Route;
use Core\ActivityLog\Http\Controllers\ActivityLogController;

Route::prefix('/api/business-access')->middleware(['business'])->group(function () {
    Route::resource('/activity-logs', ActivityLogController::class);
});