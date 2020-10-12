<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\CreateAccountController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/email/resend', [VerificationController::class, 'resend'])->name('verification.resend');
Route::get('/email/verify/{id}/{hash}', [VerificationController::class, 'verify'])->name('verification.verify');


Route::prefix('v1')->group(static function(){
    Route::prefix('users')->name('auth.')->group(static function(){
    Route::post('/createAccount', [CreateAccountController::class, 'createAccount'])->name('createAccount');
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/forgotPassword', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('forgotPassword');

});
});