<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiveScore extends Model
{
	
	public function team(){
		return $this->belongsTo('App\Team');
	}
}
