<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;


Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth'])->prefix('admin')->group(function (): void {
    Route::get('/', function () {
        return view('pages.admin.dashboard');
    });

    Route::get('/dashboard', function () {
        return view('pages.admin.dashboard');
    })->name('dashboard');

    Route::prefix('products')->controller(ProductController::class)->name('product')->group(function (): void {
        Route::get('/', 'index');
    });

    Route::prefix('category')->controller(CategoryController::class)->name('category')->group(function (): void {
        Route::get('/', 'index');
    });
});

require __DIR__.'/auth.php';

Auth::routes();
