<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;

class UserController extends Controller
{
    function userRegistration(Request $request){

    try{

       User::create([
            'fristname' => $request->fristname,
            'lastname' => $request->lastname,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => $request->input('password'),


        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'User registration successful',
          
        ], 201);

    }
    catch(Exception $e){
        return response()->json([
            'status' => 'error',
            // 'message' => 'user registration failed'
              'message' => $e->getMessage()
        ], 500);

    }

    }
    
}
