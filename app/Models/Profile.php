<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'title',
        'profile_summary',
        'address',
        'telephone',
        'mobile_phone',
        'portfolio_url',
        'github_url',
        'other_url',
        'linkedin_profile',
        'twitter_username',
        'skype_username',
    ];

    /**
     * Model relationships that would be auto-loaded with every user data by default
     */
    protected $with = [
        'work_experiences'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function work_experiences()
    {
        return $this->hasMany(WorkExperience::class)->orderBy('started_at', 'desc')->limit(10);
    }
}
