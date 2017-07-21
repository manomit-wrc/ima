<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendGroupRequest extends Model
{
    protected $fillable = ['group_id','sender_id','receiver_id','description'];

    public function doctors() {
    	return $this->belongsTo('\App\Doctor','sender_id');
    }
    public function groups() {
    	return $this->belongsTo('\App\Group','group_id');
    }
}
