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
            'firstname' => $request->firstname,
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

        $count=User::where('email', '=', $request->input('email'))
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

 try{
        //otp email address 
   Mail::to($email)->send(new OTPMail($otp));
// otp update in database
   User::where('email', '=',$email)->update(['otp' => $otp]);

   return response()->json([
    'status' => 'success',
    'message' => "OTP sent successfully"
   ]);

 }
 catch(Exception $e){
    return response()->json([
        'status' => 'error',
       'message' => $e->getMessage()
    ], 500);
 }

 

 }
 else{
    return response()->json([
        'status' => 'error',
        'message' => "Email not found"
    ], 404);
 }

    }



    function veryfyOtpCode(Request $request){
        $email = $request->input('email');
        $otp = $request->input('otp');

        $count = User::where('email', '=', $email)->where('otp', '=', $otp)->count();


        if($count==1){
            // Databse otp update
            User::where('email', '=' , $email)->update(['otp' => 0]);


   // OTP verification successful, generate JWT token for password reset
     $token = JWTToken::CreateTokenForResetPassword($request->input('email'));
            return response()->json([
                'status' => 'success',
                'message' => "OTP verification successful",
                'token' => $token
            ]);

        }
        else{
            return response()->json([
                'status' => 'error',
                'message' => "Invalid OTP"
            ], 401);
        }

        
        


    }


// function verifyOtpCode(Request $request)
// {
//     try {
//         $email = $request->input('email');
//         $otp = $request->input('otp');

//         // ১. ডাটাবেজে ইউজার এবং OTP চেক করা
//         $user = User::where('email', '=', $email)
//                     ->where('otp', '=', $otp)
//                     ->first(); // count() এর বদলে first() ব্যবহার করা ভালো

//         if($user){
//             // ২. OTP রিসেট করা
//             User::where('email', '=', $email)->update(['otp' => '0']); // null এর বদলে '0' দিয়ে ট্রাই করুন

//             // ৩. টোকেন তৈরি (নিশ্চিত হয়ে নিন এই মেথডটি আপনার হেল্পার ক্লাসে আছে কি না)
//             $token = JWTToken::CreateTokenForResetPassword($email);
            
//             return response()->json([
//                 'status' => 'success',
//                 'message' => "OTP verification successful",
//                 'token' => $token
//             ], 200);

//         } else {
//             return response()->json([
//                 'status' => 'error',
//                 'message' => "Invalid OTP"
//             ], 401);
//         }

//     } catch (Exception $e) {
//         // এই লাইনটি আপনাকে আসল সমস্যা বলে দেবে
//         return response()->json([
//             'status' => 'error',
//             'message' => $e->getMessage() 
//         ], 500);
//     }
// }




    
 }
