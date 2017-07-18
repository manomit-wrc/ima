<?php

namespace App;

use Illuminate\Foundation\Auth\Doctor as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
	use Notifiable;
	protected $table = 'doctors';

    protected $fillable = [
    	'first_name','last_name','email','mobile'
    ];

    protected $hidden = [
    	'password','active_token'
    ];
    
    public function journal() {
    	return $this->hasMany('\App\Journal','doctor_id');
    }

    public function states() {
        return $this->belongsTo('\App\State','state_id');
    }

    public function doctor_qualifications() {
        return $this->belongsToMany('\App\Qualification','doctor_qualifications','doctor_id','qualification_id');
    }
    public function doctor_groups() {
        return $this->hasMany('\App\SendGroupRequest','receiver_id');
    }
   
}
