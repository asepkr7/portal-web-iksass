<?php

use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomeController;
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

// Route::get('/dashboard/posts', [PostController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard.posts');
// Route::get('/dashboard/posts/create', [PostController::class, 'create'])->middleware(['auth', 'verified'])->name('dashboard.posts');
// Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/posts', [PostController::class, 'index'])->name('dashboard.posts');
    Route::get('/dashboard/posts/create', [PostController::class, 'create'])->name('dashboard.posts.create');
    Route::post('/dashboard/posts', [PostController::class, 'store'])->name('dashboard.posts.store');
    Route::get('/dashboard/posts/{post}/edit', [PostController::class, 'edit'])->name('dashboard.posts.edit');
    Route::put('/dashboard/posts/{post}', [PostController::class, 'update'])->name('dashboard.posts.update');
    Route::delete('/dashboard/posts/{post}', [PostController::class, 'destroy'])->name('dashboard.posts.destroy');
    Route::post('/summernote-upload', [PostController::class, 'uploadImage'])->name('summernote.upload');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/news', [HomeController::class, 'index'])->name('news');
Route::get('/news/{post}', [HomeController::class, 'show'])->name('news.show');