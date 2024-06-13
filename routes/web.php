<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\UserController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('public.welcome');
});

Route::get('/login', function(){
    if(Auth::check()){
        return redirect()->route('dashboard');
    }
    return view('auth.login');
})->name('login');


//AdminController
Route::get('/admin', function(){
    return view('admin.dashboard');
})->name('dashboard')->middleware('checkRole:Admin;Kaprodi');

Route::middleware(['checkRole:Admin'])->group(function () {
    // Route::get('admin/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    // Route::post('admin/register', [AuthController::class, 'register']);
});

// userControllter
Route::prefix('admin/')->middleware(['checkRole:Admin'])->group(function () {
    Route::get('user/', function(){
        return view('admin.manage_user.index');
    })->name('user.index');
    Route::get('user/add', function(){
        return view('admin.manage_user.create');
    })->name('user.create');
    Route::get('user/edit/{id}', function(){
        return view('admin.manage_user.edit');
    })->name('user.edit');
});

// Beranda Menu
// BeritaController
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('berita', function(){
        return view('admin.beranda.berita.index');
    })->name('berita.index');
    Route::get('berita/add', function(){
        return view('admin.beranda.berita.create');
    })->name('berita.create');
    Route::get('berita/edit/{id}', function(){
        return view('admin.beranda.berita.edit');
    })->name('berita.edit');
});

// FasilitasController
Route::prefix('admin/')->middleware(['checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('fasilitas', function(){
        return view('admin.beranda.fasilitas.index');
    })->name('fasilitas.index');
    Route::get('fasilitas/add', function(){
        return view('admin.beranda.fasilitas.create');
    })->name('fasilitas.create');
    Route::get('fasilitas/edit/{id}', function(){
        return view('admin.beranda.fasilitas.edit');
    })->name('fasilitas.edit');
});

// AkreditasiController
Route::prefix('admin/')->middleware(['checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('akreditasi', function(){
        return view('admin.beranda.akreditasi.index');
    })->name('akreditasi.index');

    Route::get('akreditasi/add', function(){
        return view('admin.beranda.akreditasi.create');
    })->name('akreditasi.create');

    Route::get('akreditasi/edit', function(){
        return view('admin.beranda.akreditasi.edit');
    })->name('akreditasi.edit');
});

// KerjasamaMitraController 
Route::prefix('admin/')->middleware(['auth:sanctum', 'checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('/kerjasama-mitra', function(){
        return view('admin.beranda.kerjasama_mitra.index');
    })->name('kerjasama_mitra.index');
    Route::get('/kerjasama-mitra/add', function(){
        return view('admin.beranda.kerjasama_mitra.create');
    })->name('kerjasama_mitra.create');
    Route::get('/kerjasama-mitra/edit/{id}', function(){
        return view('admin.beranda.kerjasama_mitra.edit');
    })->name('kerjasama_mitra.edit');
});