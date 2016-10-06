<?php

namespace App\Models\User;

use App\Models\Course\Tutorial;
use App\Models\Course\Lecture;
use App\Models\Course\Order;
use Carbon;
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

    /**
     * The dynamic properties for eager load.
     *
     * @var array
     */
    protected $with = [];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function Tutorials()
    {
        return $this->hasMany(Tutorial::class);
    }

    public function lectures()
    {
        return $this->belongsToMany(Lecture::class, 'orders');
    }

}
