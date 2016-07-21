<?php

namespace App\Models\Teacher;

use App\Scopes\Local\NextDaysTrait;
use Illuminate\Database\Eloquent\Model;

class OffTime extends Model
{
    protected $dates = ['time'];

    protected $fillable = [
        'date',
        'time_slot_id'
    ];
}
