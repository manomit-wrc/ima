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

    protected $fillable = [
    	'first_name','last_name','email','mobile'
    ];

    public function journal() {
    	return $this->hasMany('\App\Journal','doctor_id');
    }
   public function photo_50_50()
   {
      if(file_exists(public_path() . '/uploads/doctors/thumb_100_100/' . Auth::guard('admin')->doctor()->avators) && Auth::guard('admin')->doctor()->avators != "") {
          return url('uploads/doctors/thumb_100_100/' . Auth::guard('admin')->doctor()->avators);
      } else {
          return url('uploads/doctors/noimage_user.jpg');
      }
   }
}
