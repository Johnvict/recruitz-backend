<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {
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


    public function user() {
        return $this->belongsTo(User::class);
    }
}

