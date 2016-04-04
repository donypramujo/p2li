<?php
namespace App\Repositories;

use App\Status;

class StatusRepository {
	
	public  function preparation(){
		$status = Status::where('name','Preparation')->first();
		return $status;
	}
	
	public  function nomination(){
		$status = Status::where('name','Nomination')->first();
		return $status;
	}
	
	public  function ongoing(){
		$status = Status::where('name','Ongoing')->first();
		return $status;
	}
	
	public  function completed(){
		$status = Status::where('name','Completed')->first();
		return $status;
	}

	public  function canceled(){
		$status = Status::where('name','Canceled')->first();
		return $status;
	}
}