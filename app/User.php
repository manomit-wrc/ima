<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','address','mobile','avators',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function photo_100_100()
   {
      if(file_exists( public_path() . '/uploads/profile/thumb_100_100/' . Auth::guard('admin')->user()->avators) && Auth::guard('admin')->user()->avators != "") {
          return url('uploads/profile/thumb_100_100/' . Auth::guard('admin')->user()->avators);
      } else {
          return url('uploads/profile/logo.jpg');
      }
   }

   public function photo_25_25()
   {
      if(file_exists( public_path() . '/uploads/profile/thumb_25_25/' . Auth::guard('admin')->user()->avators) && Auth::guard('admin')->user()->avators != "") {
          return url('uploads/profile/thumb_25_25/' . Auth::guard('admin')->user()->avators);
      } else {
          return url('uploads/profile/logo.jpg');
      }
   }
}
