<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
    	'first_name','last_name','address','email','mobile_no','avators','serving_period','designation_id'
    ];

    public function designations() {
    	return $this->belongsTo('\App\Designation','designation_id');
    }
}
