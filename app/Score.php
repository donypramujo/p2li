<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\AuditingTrait;

class Score extends Model
{
	use AuditingTrait;
	// Disables the log record in this model.
	protected $auditEnabled  = true;
	// Disables the log record after 500 records.
	protected $historyLimit = 1000;
	// Fields you do NOT want to register.
	protected $dontKeepLogOf = ['created_at', 'updated_at'];
	// Tell what actions you want to audit.
	protected $auditableTypes = ['created', 'saved', 'deleted'];
	
	protected $guarded = ['created_at', 'updated_at'];
	
	
	public function contestant(){
		return $this->belongsTo('App\Contestant');
	}
	
	public function jury(){
		return $this->belongsTo('App\Jury');
	}
}
