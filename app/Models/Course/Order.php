<?php

namespace App\Models\Course;

use App\Models\User\Student;
use App\Models\User\Teacher;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $with = ['student', 'tutorials'];

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class);

    }

    public function tutorials()
    {
        return $this->belongsToMany(Tutorial::class);
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
