<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\BerandaController;
use App\Http\Controllers\API\MediaController;
use App\Http\Controllers\API\KategoriMediaController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\MenuController;
use App\Http\Controllers\API\KategoriPostController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\TagController;

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

// PostController 
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('post', [PostController::class, 'index']);
    Route::get('post/{id}/artikel', [PostController::class, 'get_id']); //ini mengambil data dengan katehori single-artikel
    Route::get('post/edit/{id}', [PostController::class, 'edit']); //ini mengambil data berdasarkan id post
    Route::post('post', [PostController::class, 'store']);
    Route::put('post/{id}', [PostController::class, 'update']);
    Route::delete('post/{id}', [PostController::class, 'destroy']);
});

// KategoriPostController 
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('kategori-post', [KategoriPostController::class, 'index']);
    Route::get('kategori-post/data/{kategori}', [KategoriPostController::class, 'index_kategori']);
    Route::post('kategori-post', [KategoriPostController::class, 'store']);
    Route::get('kategori-post/edit/{id}', [KategoriPostController::class, 'edit']);
    Route::put('kategori-post/{id}', [KategoriPostController::class, 'update']);
    Route::delete('kategori-post/{id}', [KategoriPostController::class, 'destroy']);
});

// TagController 
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('tag', [TagController::class, 'index']);
    Route::post('tag', [TagController::class, 'store']);
    Route::delete('tag/{id}', [TagController::class, 'destroy']);
});

// MediaController 
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('media', [MediaController::class, 'index']);
    Route::post('media', [MediaController::class, 'store']);
    Route::post('media/ckeditor', [MediaController::class, 'upload_ckeditor']);
    Route::post('media/handsontable', [MediaController::class, 'upload_handsontable']);
    Route::delete('media/{id}', [MediaController::class, 'destroy']);
    Route::delete('media-name/{name}', [MediaController::class, 'destroy_storage']);
});
// KategoriMediaController 
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('kategori-media', [KategoriMediaController::class, 'index']);
    Route::post('kategori-media', [KategoriMediaController::class, 'store']);
    Route::delete('kategori-media/{id}', [KategoriMediaController::class, 'destroy']);
});

// SettingController 
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('setting', [SettingController::class, 'index']);
    Route::post('setting', [SettingController::class, 'store']);
});

// MenuController 
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('menu', [MenuController::class, 'index']);
    Route::post('menu', [MenuController::class, 'store']);
    Route::get('menu/{id}', [MenuController::class, 'edit']);
    Route::put('menu/{id}', [MenuController::class, 'update']);
    Route::delete('menu/{id}', [MenuController::class, 'destroy']);
});

// BerandaController 
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('beranda', [BerandaController::class, 'index']);
    Route::post('beranda', [BerandaController::class, 'store']);
    Route::put('beranda', [BerandaController::class, 'update']);
    Route::delete('beranda/{id}', [BerandaController::class, 'destroy']);
});


Route::get('public/menu', [KategoriPostController::class, 'index']);
Route::get('setting', [SettingController::class, 'index']);
