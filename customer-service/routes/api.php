<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;

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

Route::prefix('v1')->name('version-1.')->group(function () {
    Route::name("no-auth.")->group(function () {
        Route::post('/signup', [AuthenticationController::class, 'signUp'])->name('customer_signup');
        Route::post('/signin', [AuthenticationController::class, 'signIn'])->name('customer_signin');
    });
});


