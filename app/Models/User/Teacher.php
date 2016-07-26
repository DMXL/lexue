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

    private $lectureUnavailabilities;

    private $offTimeUnavailabilities;

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
    | Mutators
    |--------------------------------------------------------------------------
    */
    public function setUnitPriceAttribute($value)
    {
        $this->attributes['unit_price'] = number_format($value, 2);
    }    

    /*
    |--------------------------------------------------------------------------
    | Computed properties
    |--------------------------------------------------------------------------
    */

    public function getLectureUnavailabilities()
    {
        if (isset($this->lectureUnavailabilities)) {
            return $this->lectureUnavailabilities;
        }

        $unavailabilities = [];
        $lectureTimes = $this->lectures()->followingWeek()->get();

        foreach ($lectureTimes as $lectureTime) {
            $unavailabilities[] = $lectureTime->date . '--' . $lectureTime->time_slot_id;
        }

        $this->lectureUnavailabilities = $unavailabilities;

        return $unavailabilities;
    }

    public function getOffTimeUnavailabilities()
    {
        if (isset($this->offTimeUnavailabilities)) {
            return $this->offTimeUnavailabilities;
        }

        $unavailabilities = [];

        $offTimes = $this->offTimes;
        $timeSlots = $this->timeSlots;

        foreach ($offTimes as $offTime) {
            if ($offTime->all_day) {
                foreach ($timeSlots as $timeSlot) {
                    $unavailabilities[] = $offTime->date . '--' . $timeSlot->id;
                }
            } else {
                $unavailabilities[] = $offTime->date . '--' . $offTime->time_slot_id;
            }
        }

        $this->offTimeUnavailabilities = $unavailabilities;

        return $unavailabilities;
    }

    public function getUnavailabilities()
    {
        return array_merge($this->getLectureUnavailabilities(), $this->getOffTimeUnavailabilities());
    }

    public function getTimetable()
    {
        $lectureUnavailabilities = $this->getLectureUnavailabilities();
        $offTimeUnavailabilities = $this->getOffTimeUnavailabilities();
        $unavailabilities = $this->getUnavailabilities();

        $timetable = [];
        $timeSlots = $this->timeSlots;
        for ($days = 0; $days < config('course.days_to_show'); $days++) {
            $key = Carbon::tomorrow()->addDays($days)->dayOfWeek;
            $date = Carbon::tomorrow()->addDays($days)->toDateString();
            $timetable[$key]['date'] = $date;
            foreach ($timeSlots as $timeSlot) {
                $timeSlotId = $timeSlot->id;
                $value = $date . '--' . $timeSlotId;
                $range = $timeSlot->range;
                $string = humanDate($date) . ', ' . $timeSlot->day_part . '' . $range;
                $hour = \Carbon::parse($timeSlot->start)->hour;
                if ($hour < 12) {
                    $dayPart = '上午';
                } elseif ($hour < 18) {
                    $dayPart = '下午';
                } else {
                    $dayPart = '晚上';
                }
                $timetable[$key]['times'][$value] = [
                    'time_slot_id' => $timeSlotId,
                    'dayPart' => $dayPart,
                    'value' => $value,
                    'string' => $string,
                    'date' => $date,
                    'range' => $range,
                    'disabled' => in_array($value, $unavailabilities),
                    'lecture' => in_array($value, $lectureUnavailabilities),
                    'offtime' => in_array($value, $offTimeUnavailabilities)
                ];
            }
        }
        return $timetable;
    }
}
