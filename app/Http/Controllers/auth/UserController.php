<?php

namespace App\Http\Controllers\auth;

use App\Helper\JWTToken;
use App\Http\Controllers\Controller;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{

//user registration function
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


    // user login function

    function userlogin(Request $request){

        $count=user::where('email', '=', $request->input('email'))
         ->where('password', '=', $request->input('password'))
         ->count();




// $jwt = new JWTToken();
// $token = $jwt->CreateToken($request->input('email'));




         if($count==1){
            $token = JWTToken::CreateToken($request->input('email'));  
            return response()->json([
                'status' => 'success',
                'message' => "User Login  successful",
                'token' => $token
            ]);

         }
         else {
            return response()->json([
                'status' => 'error',
                'message' => "User Login failed"
            ]);
         }


         
    }

    


    function sendOtpCode(Request $request){
        $email = $request->input('email');
        $otp = rand(100000, 999999);
        $count = User::where('email', $request->input('email'))->count();

 if($count == 1){
    //otp email address 
   Mail::to($email)->send(new OTPMail($otp));

   User::where('email', '=',$email)->update(['otp']);
 

 }
 else{
    return response()->json([
        'status' => 'error',
        'message' => "Email not found"
    ], 404);
 }

    }
    
}
