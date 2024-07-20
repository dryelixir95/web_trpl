<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\MediaController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\SubMenuController;
use App\Http\Controllers\API\SubMenuFieldController;
use App\Http\Controllers\API\DataSubMenuController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('checkRole:Admin;Kaprodi');

// UserController
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin'])->group(function () {
    Route::get('user', [UserController::class, 'index']);
    Route::post('user', [UserController::class, 'store']);
    Route::get('user/edit/{id}', [UserController::class, 'edit']);
    Route::put('user/{id}', [UserController::class, 'update']);
    Route::delete('user/{id}', [UserController::class, 'destroy']);
});

// MediaController 
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin'])->group(function () {
    Route::get('media', [MediaController::class, 'index']);
    Route::post('media', [MediaController::class, 'store']);
    Route::delete('media/{id}', [MediaController::class, 'destroy']);
});

// MenuController 
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin'])->group(function () {
    Route::get('menu', [MenuController::class, 'index']);
    Route::post('menu', [MenuController::class, 'store']);
    Route::get('menu/{id}', [MenuController::class, 'edit']);
    Route::put('menu/{id}', [MenuController::class, 'update']);
    Route::delete('menu/{id}', [MenuController::class, 'destroy']);
});

Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin'])->group(function () {
    Route::get('{kategori}', [SubMenuController::class, 'index']);
    Route::post('{kategori}', [SubMenuController::class, 'store']);
    Route::delete('{kategori}/{id}', [SubMenuController::class, 'destroy']);
});

Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin'])->group(function () {
    Route::get('{kategori}/{submenu}', [SubMenuFieldController::class, 'index']);
    Route::post('{kategori}/{submenu}', [SubMenuFieldController::class, 'store']);
});

Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin'])->group(function () {
    Route::get('{kategori}/{submenu}/data', [DataSubMenuController::class, 'index']);
    Route::post('{kategori}/{submenu}/data', [DataSubMenuController::class, 'store']);
    Route::get('{kategori}/{submenu}/data/{id}', [DataSubMenuController::class, 'edit']);
    Route::put('{kategori}/{submenu}/data/{id}', [DataSubMenuController::class, 'update']);
    Route::delete('{kategori}/{submenu}/data/{id}', [DataSubMenuController::class, 'destroy']);
});
