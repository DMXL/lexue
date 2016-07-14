<?php

namespace App\Models\User;

use App\Models\Course\Lecture;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function singleLectures()
    {
        return $this->hasMany(Lecture::class);
    }

    public function multiLectures()
    {
        return $this->belongsToMany(Lecture::class);
    }
}
