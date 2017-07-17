<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SendGroupRequest extends Model
{
    protected $fillable = ['group_id','sender_id','receiver_id','description'];
}
