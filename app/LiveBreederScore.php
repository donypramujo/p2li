<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiveBreederScore extends Model
{
	public function contest(){
		return $this->belongsTo('App\Contest');
	}
	
	public function breeder(){
		return $this->belongsTo('App\Breeder');
	}
}
