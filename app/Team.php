<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;
use OwenIt\Auditing\AuditingTrait;

class Team extends Model
{
	use Sortable,AuditingTrait;
	
	// Disables the log record in this model.
	protected $auditEnabled  = true;
	// Disables the log record after 500 records.
	protected $historyLimit = 500;
	// Fields you do NOT want to register.
	protected $dontKeepLogOf = ['created_at', 'updated_at'];
	// Tell what actions you want to audit.
	protected $auditableTypes = ['created', 'saved', 'deleted'];
	
	
	// Sortable
	protected $sortable = ['name'];
	
	// AuditingTrait
	public static $logCustomMessage = '{user.name|Anonymous} {type} a team {elapsed_time}'; // with default value
	public static $logCustomFields = [
			'name' => [
					'updated' => '{new.name} to {old.name} owns the team',
					'created' => '{new.name|No one} was defined as owner',
					'deleted' => '{old.name} was defined as owner',
			],
	];
	
	
}
