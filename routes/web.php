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
    // Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    // Route::post('/register', [AuthController::class, 'register']);

    // userControllter
    Route::prefix('admin/user')->group(function () {
        Route::get('/', function(){
            return view('admin.manage_user.index');
        })->name('user.index');
        Route::get('/add', function(){
            return view('admin.manage_user.create');
        })->name('user.create');
        Route::get('edit/{id}', function(){
            return view('admin.manage_user.edit');
        })->name('user.edit');
    });
});

// coba