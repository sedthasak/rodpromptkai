<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\SmsController;
use App\Http\Controllers\PaySolutionsController;

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
Route::get('/smsreceived/{messages}', [\App\Http\Controllers\Frontend\SmsController::class, 'store']);
Route::get('/sendsms', [\App\Http\Controllers\Frontend\SmsController::class, 'sendsms']);

Route::get('/callback', [\App\Http\Controllers\Frontend\SmsController::class, 'callbackAction']);
Route::get('/notify', [\App\Http\Controllers\Frontend\SmsController::class, 'notifyAction']);

// Route::post('/payment-return', [PaySolutionsController::class, 'paymentreturn']);
// Route::post('/payment-postback', [PaySolutionsController::class, 'paymentpostback']);
// Route::post('/payment-postback', [PaySolutionsController::class, 'paymentpostback'])
//     ->withoutMiddleware('auth:sanctum');
// Route::post('/payment-postback', [PaySolutionsController::class, 'paymentpostback'])
//     ->middleware('throttle:none');

// Route::post('/payment/back', [PaySolutionsController::class, 'handleBack'])->name('payment.back');

Route::post('/payment/postback', [PaySolutionsController::class, 'handlePostBack'])->name('payment.postback');
// Route::post('/payment/postback', function (Request $request) {
//     return response()->json(['message' => 'POST request works!!!!!!!!!!!!!!!!!!!!!']);
// });
Route::post('/test-post', function (Request $request) {
    return response()->json(['message' => 'POST request works']);
});

