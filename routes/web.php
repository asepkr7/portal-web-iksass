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

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');;
Route::post('/login', [LoginController::class, 'login'])->name('login.post')->middleware('guest');;
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/fa-verify', [TwoFactorController::class, 'showVerifyForm'])->name('2fa.verify');
Route::post('/fa-verify', [TwoFactorController::class, 'verify'])->name('2fa.verify.post');
Route::post('/fa-resend', [LoginController::class, 'resendTwoFactorCode'])->name('2fa.resend');

Route::get('/', fn() => redirect('/home'));
Route::get('/home', [HomeController::class, 'home'])->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard/posts', [PostController::class, 'index'])->name('dashboard.posts');
    Route::get('/dashboard/posts/create', [PostController::class, 'create'])->name('dashboard.posts.create');
    Route::post('/dashboard/posts', [PostController::class, 'store'])->name('dashboard.posts.store');
    Route::get('/dashboard/posts/{post}/edit', [PostController::class, 'edit'])->name('dashboard.posts.edit');
    Route::put('/dashboard/posts/{post}', [PostController::class, 'update'])->name('dashboard.posts.update');
    Route::delete('/dashboard/posts/{post}', [PostController::class, 'destroy'])->name('dashboard.posts.destroy');

    Route::get('/dashboard/posts/deleted', [PostController::class, 'deleted'])->name('dashboard.posts.deleted');
    // Restore & Hapus Massal
    Route::post('/dashboard/posts/restore-all', [PostController::class, 'restoreAll'])->name('dashboard.posts.restoreAll');
    Route::post('/dashboard/posts/force-delete-all', [PostController::class, 'forceDeleteAll'])->name('dashboard.posts.forceDeleteAll');


    // Restore & Hapus Per Item
    Route::put('/dashboard/posts/{slug}/restore', [PostController::class, 'restore'])->name('dashboard.posts.restore');
    Route::delete('/dashboard/posts/{slug}/forceDelete', [PostController::class, 'forceDelete'])->name('dashboard.posts.forceDelete');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/news', [HomeController::class, 'index'])->name('news');
Route::get('/news/{post}', [HomeController::class, 'show'])->name('news.show');
