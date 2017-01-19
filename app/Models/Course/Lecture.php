<?php

namespace App\Models\Course;

use App\Models\Teacher\Level;
use App\Models\User\Teacher;
use Carbon\Carbon;
use Codesleeve\Stapler\ORM\EloquentTrait;
use Codesleeve\Stapler\ORM\StaplerableInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Lecture
 *
 * @package App\Models\Course
 */
class Lecture extends Model implements StaplerableInterface
{
    use EloquentTrait, SoftDeletes;

    protected $appends = [
        'start_time',
        'end_time',
        'date_time',
        'arrayed_time',
        'timestamp'
    ];

    protected $fillable = [
        'name',
        'teacher_id',
        'date',
        'start',
        'length',
        'price',
        'description',
        'avatar'
    ];

    protected $with = ['teacher', 'levels'];

    public function __construct(array $attributes = array()) {
        $this->hasAttachedFile('avatar', [
            'styles' => [
                'medium' => '300x300#',
                'thumb' => '100x100#'
            ]
        ]);

        parent::__construct($attributes);
    }

    /*
    |--------------------------------------------------------------------------
    | Relations
    |--------------------------------------------------------------------------
    */
    public function teacher()
    {
        return $this->belongsTo(Teacher::class)->withTrashed();
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function levels()
    {
        return $this->belongsToMany(Level::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */
    public function getStartTimeAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i', $this->date.' '.$this->start);
    }

    public function getEndTimeAttribute()
    {
        return $this->start_time->addMinute($this->length);
    }

    public function getDateTimeAttribute()
    {
        return $this->start_time->format('Y-m-d H:i');
    }

    public function getArrayedTimeAttribute()
    {
        $time = [$this->start_time->format('Y-m-d'), $this->start_time->format('H:i')];
        return $time;
    }

    public function getTimestampAttribute()
    {
        return $this->start_time->timestamp;
    }

    /*
    |--------------------------------------------------------------------------
    | Scopes
    |--------------------------------------------------------------------------
    */
    public function scopeOrderByLatest($query)
    {
        return $query->orderBy('date', 'desc')->orderBy('start', 'desc');
    }

    public function scopeOrderByEarliest($query)
    {
        return $query->orderBy('date', 'asc')->orderBy('start', 'asc');
    }

    public function scopeFinished($query)
    {
        return $query->where('finished', 1);
    }
}
