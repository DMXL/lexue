<?php

namespace App\Models\Teacher;

use App\Scopes\Local\NextDaysTrait;
use Illuminate\Database\Eloquent\Model;

class OffTime extends Model
{
    use NextDaysTrait;

    protected $dates = ['time'];
}
