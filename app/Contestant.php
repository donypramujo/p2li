<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\AuditingTrait;
use App\Traits\Sortable;

class Contestant extends Model
{
    //
	use AuditingTrait,Sortable;
	
	// Disables the log record in this model.
	protected $auditEnabled  = true;
	// Disables the log record after 500 records.
	protected $historyLimit = 500;
	// Fields you do NOT want to register.
	protected $dontKeepLogOf = ['created_at', 'updated_at'];
	// Tell what actions you want to audit.
	protected $auditableTypes = ['created', 'saved', 'deleted'];
	
	protected $sortable = ['tank_number','subcategory_id','team_id'];
	
	public function contest(){
		return $this->belongsTo('App\Contest');
	}
	
	public function subcategory(){
		return $this->belongsTo('App\Subcategory');
	}
	
	public function team(){
		return $this->belongsTo('App\Team');
	}
	
	
	public function image(){
		
		return $this->belongsTo('App\Image');
	}
	
}
