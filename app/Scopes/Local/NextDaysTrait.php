<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 10/07/16
 * Time: 8:43 PM
 */

namespace App\Scopes\Local;


use Carbon\Carbon;

trait NextDaysTrait
{
    public function scopeNextDays($query, $days = 7)
    {
        if (property_exists($this, 'timeField')) {
            $field = $this->timeField;
        } else {
            $field = 'time';
        }

        return $query->where($field, '>' , Carbon::now()->tomorrow())
            ->where($field, '<', Carbon::now()->tomorrow()->addDays($days));
    }
}