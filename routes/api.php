<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WhatsAppController;
use App\Http\Controllers\Auth\PasswordResetWhatsappController;

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



Route::get('/wa/send', [WhatsAppController::class, 'sendFastGet']);

Route::post('/auth/wa/request-reset', [PasswordResetWhatsappController::class, 'requestReset'])
    ->middleware('throttle:5,1')
    ->name('api.password.wa.request');
