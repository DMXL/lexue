<?php

namespace App\Models\User;

use App\Models\Course\Lecture;
use App\Models\Course\TimeSlot;
use App\Models\Teacher\Level;
use App\Models\Teacher\Label;
use App\Models\Teacher\OffTime;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable
{
    protected $fillable = [
        'name',
        'unit_price',
        'teaching_since',
        'description'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['created_at', 'updated_at', 'teaching_since'];

    protected $with = ['levels', 'labels'];

    protected $appends = [
        'years_of_teaching',
        'pretty_levels',
        'pretty_labels',
        'price'
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

    public function timeSlots()
    {
        return $this->belongsToMany(TimeSlot::class);
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
            return Carbon::now()->diffInYears($teachingSince) . '年';
        }

        return '未填写';
    }

    public function getPriceAttribute()
    {
        return '￥' . number_format($this->getAttribute('unit_price'), 2);
    }

    public function getPrettyLevelsAttribute()
    {
        return implode(',', $this->levels->pluck('name')->toArray());
    }

    public function getPrettyLabelsAttribute()
    {
        return implode(',', $this->labels->pluck('name')->toArray());
    }

    /*
    |--------------------------------------------------------------------------
    | Computed properties
    |--------------------------------------------------------------------------
    */

    // TODO change name (why? I can't remember...)
    public function getUnavailabilities()
    {
        $unavailabilities = [];
        $lectureTimes = $this->lectures()->followingWeek()->get();
        $offTimes = $this->offTimes;

        $timeSlots = $this->timeSlots;

        foreach ($offTimes as $offTime) {
            if ($offTime->all_day) {
                foreach ($timeSlots as $timeSlot) {
                    $unavailabilities[] = $timeSlot->date . '--' . $timeSlot->id;
                }
            } else {
                $unavailabilities[] = $offTime->date . '--' . $offTime->time_slot_id;
            }
        }

        foreach ($lectureTimes as $lectureTime) {
            $unavailabilities[] = $lectureTime->date . '--' . $lectureTime->time_slot_id;
        }
        return $unavailabilities;
    }

    public function getTimetable($unavailabilities = null)
    {
        $unavailabilities = is_null($unavailabilities)? $this->getUnavailabilities() : $unavailabilities;

        $timetable = [];
        $timeSlots = $this->timeSlots;
        for ($days = 0; $days < config('course.days_to_show'); $days++) {
            $key = Carbon::tomorrow()->addDays($days)->dayOfWeek;
            $date = Carbon::tomorrow()->addDays($days)->toDateString();
            $timetable[$key]['date'] = $date;
            foreach ($timeSlots as $timeSlot) {
                $value = $date . '--' . $timeSlot->id;
                $range = $timeSlot->range;
                $string = humanDate($date) . ', ' . $timeSlot->day_part . '' . $range;
                $timetable[$key]['times'][$value] = [
                    'value' => $value,
                    'string' => $string,
                    'range' => $range,
                    'disabled' => in_array($value, $unavailabilities)
                ];
            }
        }
        return $timetable;
    }
}
