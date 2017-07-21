<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name','doctor_id','description','no_of_people','status'];

    public function send_group_requests() {
    	return $this->hasMany('\App\SendGroupRequest','group_id');
    }

    public function doctors() {
        return $this->belongsTo('\App\Doctor','doctor_id');
    }
}
