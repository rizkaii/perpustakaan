<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MemberController;

// ── Root redirect ──────────────────────────────────────────────────────
Route::get('/', function () {
    return redirect()->route('login');
});

// ── Auth (guest only) ──────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',    [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[AuthController::class, 'register']);
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ── User (role: user) ──────────────────────────────────────────────────
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

// ── Admin (role: admin) ────────────────────────────────────────────────
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('books',      BookController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('members',    MemberController::class);
});
