<?php

namespace App\Models\Course;

use Illuminate\Database\Eloquent\Model;

class TimeSlot extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'start',
        'end'
    ];

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
    public function getStartAttribute($value)
    {
        return preg_replace('/:\d\d$/', '', $value);
    }

    public function getEndAttribute($value)
    {
        return preg_replace('/:\d\d$/', '', $value);
    }

    public function getRangeAttribute()
    {
        return $this->start . ' - ' . $this->end;
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */
    public function scopeOrderByStart($query)
    {
        return $query->orderBy('start');
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
        return (int ) substr($this->attributes['start'], 0, 2);
    }
}
