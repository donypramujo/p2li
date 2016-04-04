<?php
namespace App\Repositories;


use App\Contest;

class ContestRepository {
	
	public  function getCurrent(){
		
		$contest = Contest::whereHas('status',function($query){
			$query->whereIn('name',['Preparation','Nomination','Ongoing']);
		})->first();
		
		return $contest;
	}
	
}