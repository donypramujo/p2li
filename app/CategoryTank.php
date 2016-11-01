<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTank extends Model
{
	public function subcategory(){
		return $this->belongsTo('App\Subcategory');
	}
	
	public function contest(){
		return $this->belongsTo('App\Contest');
	}
}
