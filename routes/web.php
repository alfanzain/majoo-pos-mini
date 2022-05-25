<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function (): void {
    Route::prefix('products')->controller(ProductController::class)->name('product')->group(function (): void {
        Route::get('/', 'index');
    });

    Route::prefix('category')->controller(CategoryController::class)->name('category')->group(function (): void {
        Route::get('/', 'index');
    });
});

require __DIR__.'/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
