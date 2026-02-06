<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table= 'users';
    protected $fillable = [
        'fristname',
        'lastname',
        'email',
        'phone',
        'password',
        'otp',
    ];

    protected $attributes = [
        'otp' => '0'
    ];
}
