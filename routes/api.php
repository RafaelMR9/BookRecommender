<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getRecommendations', [BookController::class, 'getRecommendations']);
Route::get('/searchBooks', [BookController::class, 'searchBooks']);
Route::post('/rateBook', [BookController::class, 'rateBook']);
Route::get('/bookDetails/{id}', [BookController::class, 'bookDetails']);
Route::match(['post', 'put'], '/userPreferences', [UserController::class, 'userPreferences']);
Route::get('/newReleases', [BookController::class, 'newReleases']);
Route::get('/trendingBooks', [BookController::class, 'trendingBooks']);
Route::get('/authorInfo/{authorId}', [BookController::class, 'authorInfo']);
Route::get('/userHistory/{userId}', [UserController::class, 'userHistory']);
Route::get('/popularGenres', [BookController::class, 'popularGenres']);