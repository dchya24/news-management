<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('guest:api')->group(function(){
    Route::post('login', LoginController::class)->name('login');
    Route::post('register', RegisterController::class)->name('register');

});

Route::middleware('auth:api')->group(function(){
    Route::post('logout', LogoutController::class)->name('logout');

    Route::prefix('news')->group(function(){
        Route::post('', [NewsController::class, 'createNews']);
        Route::get('', [NewsController::class, 'getNews']);
        Route::get('/slug/{slug}', [NewsController::class, 'getNewsDetailBySlug']);
        Route::get('/{id}', [NewsController::class, 'getNewsDetailById']);
        Route::put('/{id}/update', [NewsController::class, 'updateNews']);

        // Menggunakan Middleware karna tidak divalidasi di FormRequest
        Route::delete('/{id}/delete', [NewsController::class, 'deleteNews'])
            ->middleware('scope:delete-news');
    });

    Route::post('comment', CommentController::class);
});
Route::get('', [NewsController::class, 'getNews']);
Route::post('', [NewsController::class, 'createNews']);
