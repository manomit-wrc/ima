<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comments';
    protected $fillable = [
        'doctor_id', 'comment', 'group_id','replay_id','file'
    ];
}
