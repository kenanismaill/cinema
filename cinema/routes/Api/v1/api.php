<?php

use App\Http\Controllers\Api\v1\BookingChair\BookingChairController;
use App\Http\Controllers\Api\v1\Cinema\CinemaController;
use App\Http\Controllers\Api\v1\City\CityController;
use App\Http\Controllers\Api\v1\Film\FilmController;
use App\Http\Controllers\Api\v1\Oauth\AuthenticatedController;
use App\Http\Controllers\Api\v1\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['guest'])->controller(AuthenticatedController::class)->group(function () {
    Route::post('login', 'login')->name('oauth.login');
});



Route::middleware(['auth:api'])->group(function () {
    Route::apiResource('film', FilmController::class);
    Route::apiResource('city', CityController::class);
    Route::apiResource('cinema', CinemaController::class);
    Route::post('film/{film}/chair/{chair}/booking',[BookingChairController::class,'store']);
    Route::get('user/{user}/ticket',[UserController::class,'tickets'])->name('user.ticket');
});


