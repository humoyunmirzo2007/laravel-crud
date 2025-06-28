<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use Illuminate\Support\Facades\Route;

Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

Route::middleware(["auth:sanctum"])->group(function () {
    Route::get("brands/get-brands", [BrandController::class, "index"]);
    Route::get("brands/get-brands/{id}", [BrandController::class, "getById"]);
    Route::post("brands/create", [BrandController::class, "create"]);
    Route::put("brands/update/{id}", [BrandController::class, "update"]);
    Route::put("brands/update-active/{id}", [BrandController::class, "updateActive"]);
    Route::delete("brands/delete/{id}", [BrandController::class, "delete"]);
});
