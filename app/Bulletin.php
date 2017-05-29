<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bulletin extends Model
{
    protected $fillable = [
    	'name','bulletin_image','bulletin_file','status'
    ];
}
