<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{

    protected $appends = [
        'day_part',
        'range',
        'hour'
    ];

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */
    public function getFromAttribute($value)
    {
        return preg_replace('/:\d\d$/', '', $value);
    }

    public function getToAttribute($value)
    {
        return preg_replace('/:\d\d$/', '', $value);
    }

    public function getRangeAttribute()
    {
        return $this->from . ' - ' . $this->to;
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */
    public function getDayPartAttribute()
    {
        $hour = $this->hour;

        if ($hour < 12) {
            return '上午';
        } elseif ($hour < 19) {
            return '下午';
        } else {
            return '晚上';
        }
    }

    public function getHourAttribute()
    {
        return (int ) substr($this->attributes['from'], 0, 2);
    }
}
