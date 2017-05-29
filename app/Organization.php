<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $fillable = [
        'name', 'email', 'alternate_email','address','phone','facebook_link','twitter_link'
    ];
}
