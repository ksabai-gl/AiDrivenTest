<?php

// Web routes for Authencation

use Core\Authencation\Http\Controllers\SessionAuthencationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->prefix('/dashboard/authencation')->group(function () {
    Route::get("/web-login", [SessionAuthencationController::class,"login"]);
    Route::get("/web-logout", [SessionAuthencationController::class,"logout"]);
});