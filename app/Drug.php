<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    protected $fillable = ['title','description','department_id','doctor_id','image','mfg_name','unit','price','video'];
}
