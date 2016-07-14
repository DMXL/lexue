<?php

namespace App\Models\User;

use App\Models\Course\Lecture;
use App\Models\Teacher\Level;
use App\Models\Teacher\Label;
use App\Models\Teacher\OffTime;
use Carbon\Carbon;
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

    protected $with = ['levels', 'labels'];

    protected $appends = [
        'years_of_teaching'
    ];
    
    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function levels()
    {
        return $this->belongsToMany(Level::class);
    }

    public function labels()
    {
        return $this->belongsToMany(Label::class);
    }

    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

    public function offTimes()
    {
        return $this->hasMany(OffTime::class);
    }
    
    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */
    public function getYearsOfTeachingAttribute()
    {
        $teachingSince = $this->teaching_since ? : null;

        if ($teachingSince) {
            return Carbon::now()->diffInYears($teachingSince);
        }

        return null;
    }

    /*
    |--------------------------------------------------------------------------
    | Computed properties
    |--------------------------------------------------------------------------
    */

    // TODO change name
    public function getUnavailabilities()
    {
        $unavailabilities = [];
        $lectureTimes = $this->lectures()->nextDays()->get();
        $offTimes = $this->offTimes()->nextDays()->get();

        foreach ($offTimes as $offTime) {
            if ($offTime->all_day) {
                $offDay = $offTime->time->startOfDay();
                for ($hour = config('course.day_start'); $hour <= config('course.day_end'); $hour++) {
                    $unavailabilities[] = $offDay->addHours($hour);
                }
            } else {
                $unavailabilities[] = $offTime->time;
            }
        }

        foreach ($lectureTimes as $lectureTime) {
            $unavailabilities[] = $lectureTime->start_at;
        }
        return $unavailabilities;
    }

    public function getTimetable($unavailabilities = null)
    {
        $unavailabilities = is_null($unavailabilities)? $this->getUnavailabilities() : $unavailabilities;

        $timetable = [];
        for ($days = 0; $days < config('course.days_to_show'); $days++) {
            $key = Carbon::tomorrow()->addDays($days)->dayOfWeek;
            for ($hours = config('course.day_start'); $hours <= config('course.day_end'); $hours++) {
                $time = Carbon::tomorrow()->addDays($days)->addHours($hours);
                $timetable[$key][] = [
                    'time' => $time,
                    'disabled' => in_array($time, $unavailabilities)
                ];
            }
        }
        return $timetable;
    }
}
