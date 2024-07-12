<?php

use Illuminate\Support\Facades\Route;
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

// userControllter
Route::prefix('admin/')->middleware(['checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('media/', function(){
        return view('admin.manage_media.index');
    })->name('media.index');
    Route::get('media/add', function(){
        return view('admin.manage_media.create');
    })->name('media.create');
    Route::get('media/edit/{id}', function(){
        return view('admin.manage_media.edit');
    })->name('media.edit');
});

Route::prefix('admin/')->middleware(['checkRole:Admin'])->group(function () {
    Route::get('menu/', function(){
        return view('admin.manage_menu.index');
    })->name('menu.index');
    Route::get('menu/add', function(){
        return view('admin.manage_menu.create');
    })->name('menu.create');
    Route::get('menu/edit/{id}', function(){
        return view('admin.manage_menu.edit');
    })->name('menu.edit');


// sub
    Route::get('menu/{slug}', function(){
        return view('admin.menu.index');
    });
    Route::get('menu/{slug}/add', function(){
        return view('admin.menu.create');
    })->name('submenu.create');
});