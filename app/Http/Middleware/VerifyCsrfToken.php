<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    protected $except = [
        '/user-registration',
        //  '/user-registration/',
    
        // 'api/*', 
        '/user-login',
    ];







}

