<?php

namespace App\Models\User;

use App\Models\Course\Lecture;
use App\Models\Course\Order;
use App\Models\Course\TimeSlot;
use App\Models\Course\Tutorial;
use App\Models\Teacher\Level;
use App\Models\Teacher\Label;
use App\Models\Teacher\OffTime;
use Carbon\Carbon;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable implements StaplerableInterface
{
    use SoftDeletes, EloquentTrait;

    protected $perPage = 16;

    protected $fillable = [
        'name',
        'email',
        'unit_price',
        'teaching_since',
        'description',
        'avatar',
        'video'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['teaching_since', 'deleted_at'];

    protected $with = ['levels', 'labels', 'orders'];

    protected $appends = [
        'years_of_teaching',
        'pretty_levels',
        'pretty_labels',
        'price'
    ];

    private $tutorialUnavailabilities;

    private $offTimeUnavailabilities;

    /**
     * Teacher constructor.
     * @param array $attributes
     */
    public function __construct(array $attributes = array())
    {
        $this->hasAttachedFile('avatar', [
            'styles' => [
                'medium' => '300x300#',
                'thumb' => '100x100#'
            ]
        ]);
        $this->hasAttachedFile('video');

        parent::__construct($attributes);
    }

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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function tutorials()
    {
        return $this->hasMany(Tutorial::class);
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

    public function setTeachingSinceAttribute($value)
    {
        $this->attributes['teaching_since'] = \Carbon::parse($value . '-00-00');
    }

    /*
    |--------------------------------------------------------------------------
    | Computed properties
    |--------------------------------------------------------------------------
    */
    public function getTutorialUnavailabilities()
    {
        if (isset($this->tutorialUnavailabilities)) {
            return $this->tutorialUnavailabilities;
        }

        $unavailabilities = [];
        $tutorials = $this->tutorials()->followingWeek()->get();

        foreach ($tutorials as $tutorial) {
            $unavailabilities[] = $tutorial->date . '--' . $tutorial->time_slot_id;
        }

        $this->tutorialUnavailabilities = $unavailabilities;

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
        return array_merge(
            $this->getOffTimeUnavailabilities(),
            $this->getTutorialUnavailabilities()
        );
    }

    public function getTimetable()
    {
        $tutorialUnavailabilities = $this->getTutorialUnavailabilities();
        $offTimeUnavailabilities = $this->getOffTimeUnavailabilities();
        $unavailabilities = $this->getUnavailabilities();

        $timetable = [];
        $timeSlots = $this->timeSlots;

        if ($timeSlots->count() === 0) {
            return [];
        }

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
                    'offtime' => in_array($value, $offTimeUnavailabilities),
                    'tutorial' => in_array($value, $tutorialUnavailabilities),
                ];
            }
        }
        return $timetable;
    }
}
