<?php

namespace App;

use App\Traits\Sortable;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\AuditingTrait;

class Breeder extends Model
{
	use Sortable,AuditingTrait;
	
	// Disables the log record in this model.
	protected $auditEnabled  = false;
	// Disables the log record after 500 records.
	protected $historyLimit = 500;
	// Fields you do NOT want to register.
	protected $dontKeepLogOf = ['created_at', 'updated_at'];
	// Tell what actions you want to audit.
	protected $auditableTypes = ['created', 'saved', 'deleted'];
	
	
	// Sortable
	protected $sortable = ['name'];
	
	
	
}
