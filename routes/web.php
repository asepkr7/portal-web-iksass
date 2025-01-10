<?php

use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
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
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/fa-verify', [TwoFactorController::class, 'showVerifyForm'])->name('2fa.verify');
Route::post('/fa-verify', [TwoFactorController::class, 'verify'])->name('2fa.verify.post');
Route::post('/fa-resend', [LoginController::class, 'resendTwoFactorCode'])->name('2fa.resend');

Route::get('/dashboard/post', [PostController::class, 'index']);
Route::get('/dashboard', function () {
    return 'Selamat Datang di Dashboard!';
})->middleware(['auth', 'verified'])->name('dashboard');