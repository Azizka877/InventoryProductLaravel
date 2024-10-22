<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuppliersController;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('products', ProductController::class);

Route::get('/suppliers', [SuppliersController::class, 'index'])->name('suppliers.index');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');