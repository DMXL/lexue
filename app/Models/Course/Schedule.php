<?php

namespace App\Models\Course;

use App\Models\User\Student;
use App\Models\User\Teacher;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    protected $table = 'schedules';

    protected $fillable = [
        'student_id',
        'teacher_id',
        'course_id',
        'course_type',
        'date',
        'start',
        'end'
    ];
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

    public function course()
    {
        return $this->morphTo();
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */
    public function getStartTimeAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->date.' '.$this->start);
    }

    public function getEndTimeAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->date.' '.$this->end);
    }

    /*
    |--------------------------------------------------------------------------
    | Mutators
    |--------------------------------------------------------------------------
    */

    //

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */
    public function scopeOrderByEarliest($query)
    {
        return $query->orderBy('date', 'asc')->orderBy('start', 'asc');
    }

    public function scopeWithinCurrentWeek($query)
    {
        return $query->where([
            ['date', '>=', Carbon::now()->toDateString()],
            ['date', '<', Carbon::now()->addDays(config('course.days_to_show') - 1)->toDateString()],
        ]);
    }
}
