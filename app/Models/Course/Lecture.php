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
        'shorter_start',
        'carbon_start',
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
        return $this->date.' '.$this->start;
    }

    public function getCarbonStartAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->start_time);
    }

    public function getEndTimeAttribute()
    {
        return $this->carbon_start->addMinute($this->length);
    }

    public function getShorterTimeAttribute()
    {
        return $this->carbon_start->format('H:i');
    }

    public function getTimestampAttribute()
    {
        return $this->carbon_start->timestamp;
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
