<?php

namespace App\Models\Course;

use App\Models\User\Student;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function lectures()
    {
        return $this->belongsToMany(Lecture::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Mutators
    |--------------------------------------------------------------------------
    */
    public function setTotalAttribute($value)
    {
        $this->attributes['total'] = number_format($value, 2);
    }
}
