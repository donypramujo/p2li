<?php
namespace App\Repositories;


use App\Contest;
use Illuminate\Support\Facades\Auth;
use App\Jury;

class JuryRepository {
	
	public function getJury(Contest $contest){
		$user = Auth::user();
		$jury = Jury::where('user_id',$user->id)->where('contest_id',$contest->id)->first();
		
		return $jury;
	}
	
}