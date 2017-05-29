<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
   	protected $fillable = [
   		'name','event_category_id','event_venue','event_date','description'
   	];

   	public function event_categories() {
   		return $this->belongsTo('\App\EventCategory','event_category_id');
   	}
}
