<?php

use App\Http\Controllers\auth\UserController;
use Illuminate\Support\Facades\Route;




Route::post('/user-registration', [UserController::class, 'userRegistration']);