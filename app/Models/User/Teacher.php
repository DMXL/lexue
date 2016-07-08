<?php

namespace App\Models\User;

use App\Models\Teaching\Level;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    protected $fillable = [
        'name'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['created_at', 'updated_at', 'teaching_since'];

    protected $with = ['levels'];
    
    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function levels()
    {
        return $this->belongsToMany(Level::class);
    }
}
