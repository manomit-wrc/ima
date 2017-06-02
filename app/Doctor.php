<?php

namespace App;

use Illuminate\Foundation\Auth\Doctor as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Doctor extends Authenticatable
{
	use Notifiable;
	protected $table = 'doctors';

    protected $hidden = [
    	'password'
    ];
}
