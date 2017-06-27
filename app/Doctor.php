<?php

namespace App;

use Illuminate\Foundation\Auth\Doctor as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
	use Notifiable;
	protected $table = 'doctors';

    protected $hidden = [
    	'password','active_token'
    ];

    protected $fillable = [
    	'first_name','last_name','email','mobile'
    ];

    public function journal() {
    	return $this->hasMany('\App\Journal','doctor_id');
    }

    public function states() {
        return $this->belongsTo('\App\State','state_id');
    }
   
}
