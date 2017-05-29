<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocalBranch extends Model
{
    protected $fillable = [
    	'branch_name','branch_head','designation_id','branch_address','mobile_no','phone_no','email_id','branch_image','status'
    ];

    public function designations() {
    	return $this->belongsTo('\App\Designation','designation_id');
    }
}
