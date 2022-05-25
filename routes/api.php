<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\V1\ProductController;


// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix' => 'v1'], function (): void {
    Route::prefix('products')->controller(ProductController::class)->name('product')->group(function (): void {
        Route::get('/', 'get');
        Route::get('/{id}', 'show');
        Route::post('/', 'store');
        Route::delete('/{id}', 'destroy');
    });
});
