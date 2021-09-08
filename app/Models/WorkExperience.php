<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    protected $fillable = [
        'user_id',
        'profile_id',
        'title',
        'company_name',
        'job_title',
        'job_summary',
        'started_at',
        'left_at',
        'still_active',
    ];

    protected $casts = [
        'still_active' => 'boolean',
        'started_at'    => 'date',
        'left_at'    => 'date'
    ];
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function setStartedAtAttribute($value)
    {
        $this->attributes['started_at'] = Carbon::parse($value);
    }
    public function setLeftAtAttribute($value)
    {
        $this->attributes['left_at'] = $value ? Carbon::parse($value) : null;
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
