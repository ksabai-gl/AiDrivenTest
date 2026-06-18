<?php

use Extensions\Hrm\Http\Controllers\Api\LeaveRequestController;
use Extensions\Hrm\Http\Controllers\Api\AttendanceController;
use Extensions\Hrm\Http\Controllers\Api\ExportExcelController;
use Extensions\Hrm\Http\Controllers\Api\ReportController;
use Illuminate\Support\Facades\Route;

Route::prefix('/api/extension/hrm')->middleware(['business'])->group(function () {
    // Leave Management
    Route::resource('leave', LeaveRequestController::class);
    Route::resource('attendance', AttendanceController::class);
    Route::resource('report', ReportController::class);
    Route::resource('export', ExportExcelController::class);
});