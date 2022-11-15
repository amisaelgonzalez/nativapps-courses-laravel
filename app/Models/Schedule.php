<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'start_time',
        'end_time',
        'monday',
        'tuesday',
        'wednesday',
        'thursday',
        'friday',
        'saturday',
        'sunday',
        'course_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'monday'    => 'boolean',
        'tuesday'   => 'boolean',
        'wednesday' => 'boolean',
        'thursday'  => 'boolean',
        'friday'    => 'boolean',
        'saturday'  => 'boolean',
        'sunday'    => 'boolean',
        'course_id' => 'integer',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'days',
        'range_of_hours',
    ];

    /**
     * Get the selected days.
     *
     * @param  string  $value
     * @return string
     */
    public function getDaysAttribute($value)
    {
        $days[] = $this->attributes['monday']       ? 'monday'      : null;
        $days[] = $this->attributes['tuesday']      ? 'tuesday'     : null;
        $days[] = $this->attributes['wednesday']    ? 'wednesday'   : null;
        $days[] = $this->attributes['thursday']     ? 'thursday'    : null;
        $days[] = $this->attributes['friday']       ? 'friday'      : null;
        $days[] = $this->attributes['saturday']     ? 'saturday'    : null;
        $days[] = $this->attributes['sunday']       ? 'sunday'      : null;

        return collect($days)->filter()->join(', ');
    }

    /**
     * Get the Range of hours (start_time, end_time).
     *
     * @param  string  $value
     * @return string
     */
    public function getRangeOfHoursAttribute($value)
    {
        $start_time = Carbon::parse($this->attributes['start_time'])->format('h:i A');
        $end_time   = Carbon::parse($this->attributes['end_time'])->format('h:i A');

        return $start_time . ' - ' . $end_time;
    }

    /**
     * Get the course that owns the schedules.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
