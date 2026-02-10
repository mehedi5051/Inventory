<?php

namespace App\Helper;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;



class JWTToken {
    function createToken($userEmail){
         $key = env('JWT_key');
        // Verification logic would go here
        $payLoad = [
            'iss' => 'laravel-token',
            'iat' => time(),
            'exp' => time() +(60*60),
            'userEmail' => $userEmail
        ];

        return JWT::encode($payLoad, $key , 'HS256');



    }

    function verifyToken($token){

    try{
        
        $key = env('JWT_key');
        $decoded = JWT::decode($token, new key($key, 'HS256'));
        return $decoded->userEmail;


    } catch(\Exception $e){
        return 'invalid token';
    }



       
    }
}