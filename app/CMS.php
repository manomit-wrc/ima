<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CMS extends Model
{
	public $table = "c_m_s";
    protected $fillable = [
    	'title','slug','short_description','full_description','status'
    ];
}
