<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CostumerController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    return view('pages.landing');
});

// Auth::routes(['verify' => true]);

Route::middleware(['guest'])->group(function(){
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authentication']);
    Route::get('/register', [AuthController::class, 'register'])->name('Auth.pages.register');
    Route::post('/register', [AuthController::class, 'registerauth']);
});

Route::middleware(['auth'])->group(function(){
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth', 'OnlyAdmin'])->group(function () {
    Route::get('admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('admin/profile', [UserController::class, 'profileadmin']);
    Route::get('users', [AdminController::class, 'users'])->name('admin.users');
    Route::get('kamar', [AdminController::class, 'kamar'])->name('admin.kamar');
});

Route::middleware(['auth', 'OnlyPegawai'])->group(function(){
    Route::get('pegawai', [PegawaiController::class, 'dashboard']);
    Route::get('pegawai/profile', [UserController::class, 'profilepegawai']);
});

Route::middleware(['auth', 'OnlyCostumer'])->group(function(){
    Route::get('costumer', [CostumerController::class, 'landing']);
    Route::get('costumer/profile', [UserController::class, 'profileCostumer']);
});
