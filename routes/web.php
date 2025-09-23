<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\Admin\AdminOrderController;
use Illuminate\Support\Facades\Route;

// Halaman utama (public)
Route::get('/', function () {
    return view('welcome');
})->name('home');

// Untuk user biasa
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
});

// Untuk admin
 Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/admindashboard', [AdminController::class, 'index'])->name('admin.admindashboard');
});

Route::post('/order', [OrderController::class, 'store'])->name('order.store');

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/orders', [AdminOrderController::class, 'index'])->name('admin.orders');
});

// Semua route Breeze (register, login, logout, forgot password, dll)
require __DIR__.'/auth.php';
