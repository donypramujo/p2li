<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Sortable;

class Team extends Model
{
	use Sortable;
	
	protected $sortable = ['name'];
}
