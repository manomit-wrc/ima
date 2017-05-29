<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
    	'title','description','published_date','status'
    ];

    public function tags() {
    	return $this->belongsToMany('\App\Tag','news_tag','news_id','tag_id');
    }
}
