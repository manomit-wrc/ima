<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
     public function categories() {
    	return $this->belongsTo('\App\Category','category_id');
    }

    
}
