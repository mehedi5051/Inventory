<?php

use App\Http\Controllers\auth\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::post('/user-registration', [UserController::class, 'userRegistration']);

Route::post('/user-login', [UserController::class, 'userlogin']);
Route::post('/send-otp', [UserController::class, 'sendOtpCode']);

Route::post('/veryfy-otp', [UserController::class, 'veryfyOtpCode']);

Route::post('/reset-password', [UserController::class, 'resetPassword'])->middleware(TokenVerificationMiddleware::class);









// Route::get('/mail-test', function () {
//     try {
//         Mail::raw('Test Mail', function ($message) {
//             $message->to('test@example.com')
//                     ->subject('Test Mail');
//         });
//         return "Mail Sent";
//     } catch (\Exception $e) {
//         return $e->getMessage();
//     }
// });