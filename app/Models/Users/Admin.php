<?php

namespace App\Models\Users;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
}
