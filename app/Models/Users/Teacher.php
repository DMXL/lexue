<?php

namespace App\Models\Users;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
