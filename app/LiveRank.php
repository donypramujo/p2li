<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LiveRank extends Model
{
	
	public function team(){
		return $this->belongsTo('App\Team');
	}
	
	public function contestant(){
		return $this->belongsTo('App\Contestant');
	}
	
	public function subcategory(){
		return $this->belongsTo('App\Subcategory');
	}
	
	public function contest(){
		return $this->belongsTo('App\Contest');
	}
	
	public function title(){
		return $this->belongsTo('App\Title');
	}
}
