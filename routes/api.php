<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

// AUTH
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);

// BRANDS
Route::middleware(["auth:sanctum"])->prefix("brands")->group(function () {
    Route::get("get-brands", [BrandController::class, "index"]);
    Route::get("get-active-brands", [BrandController::class, "getActive"]);
    Route::get("get-brands/{id}", [BrandController::class, "getById"]);
    Route::post("create", [BrandController::class, "create"]);
    Route::put("update/{id}", [BrandController::class, "update"]);
    Route::put("update-active/{id}", [BrandController::class, "updateActive"]);
    Route::delete("delete/{id}", [BrandController::class, "delete"]);
});

// CATEGORIES
Route::middleware(["auth:sanctum"])->prefix("categories")->group(function () {
    Route::get("get-categories", [CategoryController::class, "index"]);
    Route::get("get-active-categories", [CategoryController::class, "getActive"]);
    Route::get("get-categories/{id}", [CategoryController::class, "getById"]);
    Route::post("create", [CategoryController::class, "create"]);
    Route::put("update/{id}", [CategoryController::class, "update"]);
    Route::put("update-active/{id}", [CategoryController::class, "updateActive"]);
    Route::delete("delete/{id}", [CategoryController::class, "delete"]);
});
