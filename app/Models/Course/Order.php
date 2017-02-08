<?php

namespace App\Models\Course;

use App\Models\User\Student;
use App\Models\User\Teacher;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
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
        return $this->belongsTo(Teacher::class)->withTrashed();
    }

    public function lecture()
    {
        return $this->belongsTo(Lecture::class)->withTrashed();
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

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */
    public function scopePaid($query)
    {
        return $query->where('paid', true);
    }
}
