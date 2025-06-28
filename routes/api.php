<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

// AUTH

Route::prefix(("auth"))->group(function () {
    Route::post("register", [AuthController::class, "register"]);
    Route::post("login", [AuthController::class, "login"]);
    Route::post("logout", [AuthController::class, "logout"])->middleware(["auth:sanctum"]);
});


// BRANDS
Route::prefix("brands")->middleware(["auth:sanctum"])->group(function () {
    Route::get("get-all", [BrandController::class, "getAll"]);
    Route::get("get-all-active", [BrandController::class, "getAllActive"]);
    Route::get("get-by-id/{id}", [BrandController::class, "getById"]);
    Route::post("create", [BrandController::class, "create"]);
    Route::put("update/{id}", [BrandController::class, "update"]);
    Route::put("update-active/{id}", [BrandController::class, "updateActive"]);
    Route::delete("delete/{id}", [BrandController::class, "delete"]);
});

// CATEGORIES
Route::prefix("categories")->middleware(["auth:sanctum"])->group(function () {
    Route::get("get-all", [CategoryController::class, "getAll"]);
    Route::get("get-all-active", [CategoryController::class, "getAllActive"]);
    Route::get("get-by-id/{id}", [CategoryController::class, "getById"]);
    Route::post("create", [CategoryController::class, "create"]);
    Route::put("update/{id}", [CategoryController::class, "update"]);
    Route::put("update-active/{id}", [CategoryController::class, "updateActive"]);
    Route::delete("delete/{id}", [CategoryController::class, "delete"]);
});

// PRODUCTS
Route::prefix("products")->middleware("auth:sanctum")->group(function () {
    Route::get("get-all", [ProductController::class, "getAll"]);
    Route::get("get-all-active", [ProductController::class, "getAllActive"]);
    Route::get("get-by-id/{id}", [ProductController::class, "getById"]);
    Route::get("get-by-category-id/{id}", [ProductController::class, "getByCategoryId"]);
    Route::get("get-by-brand-id/{id}", [ProductController::class, "getByBrandId"]);
    Route::post("create", [ProductController::class, "create"]);
    Route::post("update/{id}", [ProductController::class, "update"]);
    Route::put("update-active/{id}", [ProductController::class, "updateActive"]);
    Route::delete("delete/{id}", [ProductController::class, "delete"]);
});
