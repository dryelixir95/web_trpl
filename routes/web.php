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
    return view('public.beranda');
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

Route::prefix('admin/')->middleware(['checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('post/', function(){
        return view('admin.manage_post.index');
    })->name('post.index');
    Route::get('post/add', function(){
        return view('admin.manage_post.create');
    })->name('post.create');
    Route::get('post/edit/{id}', function(){
        return view('admin.manage_post.edit');
    })->name('post.edit');
});

Route::prefix('admin/')->middleware(['checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('kategori-post/', function(){
        return view('admin.kategori_post.index');
    })->name('kategori-post.index');
    Route::get('kategori-post/add', function(){
        return view('admin.kategori_post.create');
    })->name('kategori-post.create');
    Route::get('kategori-post/edit/{id}', function(){
        return view('admin.kategori_post.edit');
    })->name('kategori-post.edit');
});

Route::prefix('admin/')->middleware(['checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('halaman/', function(){
        return view('admin.manage_halaman.index');
    })->name('halaman.index');
    Route::get('halaman/add', function(){
        return view('admin.manage_halaman.create');
    })->name('halaman.create');
    Route::get('halaman/edit/{id}', function(){
        return view('admin.manage_halaman.edit');
    })->name('halaman.edit');
});
Route::prefix('admin/')->middleware(['checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('kategori-halaman/', function(){
        return view('admin.kategori_halaman.index');
    })->name('kategori-halaman.index');
    Route::get('kategori-halaman/add', function(){
        return view('admin.kategori_halaman.create');
    })->name('kategori-halaman.create');
    Route::get('kategori-halaman/edit/{id}', function(){
        return view('admin.kategori_halaman.edit');
    })->name('kategori-halaman.edit');
});

Route::prefix('admin/')->middleware(['checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('tag/', function(){
        return view('admin.manage_tag.index');
    })->name('tag.index');
    Route::get('tag/add', function(){
        return view('admin.manage_tag.create');
    })->name('tag.create');
    Route::get('tag/edit/{id}', function(){
        return view('admin.manage_tag.edit');
    })->name('tag.edit');
});

// mediaControllter
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

Route::prefix('admin/')->middleware(['checkRole:Admin;Kaprodi'])->group(function () {
    Route::get('kategori-media/', function(){
        return view('admin.kategori_media.index');
    })->name('kategori-media.index');
    Route::get('kategori-media/add', function(){
        return view('admin.kategori_media.create');
    })->name('kategori-media.create');
    Route::get('kategori-media/edit/{id}', function(){
        return view('admin.kategori_media.edit');
    })->name('kategori-media.edit');
});

Route::prefix('admin/')->middleware(['checkRole:Admin'])->group(function () {
    Route::get('setting/', function(){
        return view('admin.setting.index');
    })->name('setting.index');
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
});

Route::prefix('admin/')->middleware(['checkRole:Admin;Kaprodi'])->group(function () {
    // beranda
    Route::get('beranda', function(){
        return view('admin.beranda.index');
    })->name('beranda.index');
    Route::get('beranda/add', function(){
        return view('admin.beranda.create');
    })->name('beranda.create');


// sub-menu
    Route::get('/{formattedUrl}', function(){
        return view('admin.menu.index');
    });
    Route::get('/{formattedUrl}/add', function(){
        return view('admin.menu.create');
    });
    Route::get('/{formattedUrl}/edit/{id}', function(){
        return view('admin.menu.edit');
    });
});

// public
Route::get('/{kategori}', function(){
    return view('public.menu.index');
});
Route::get('/{kategori}/{slug}', function(){
    return view('public.menu.detail');
});
