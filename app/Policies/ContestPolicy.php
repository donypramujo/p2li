<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\User;
use App\Contest;
use App\Repositories\ContestRepository;

class ContestPolicy
{
    use HandlesAuthorization;
    
    protected  $contests;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(ContestRepository $contests)
    {
        $this->contests=$contests;
    }
    
    public function store(User $user,Contest $contest){
    	return empty($this->contests->getCurrent());
    }
    
    
    public function update(User $user,Contest $contest){
    	
    	if(empty($contest)){
    		return FALSE;
    	}
    	return in_array( $contest->status->name,['Preparation','Nomination','Ongoing']);
    }
    
    public function destroy(User $user,Contest $contest){
    	if(empty($contest)){
    		return FALSE;
    	}
    	
    	return in_array($contest->status->name,['Preparation','Nomination']);
    }
    
    
    public function manageJury(User $user,Contest $contest){
    	$contest = $this->contests->getCurrent();
    	if(empty($contest)){
    		return FALSE;
    	}
    	
    	return in_array($contest->status->name,['Preparation','Nomination']);
    }
    
    public function manageContestant(User $user,Contest $contest){
    	$contest = $this->contests->getCurrent();
    	if(empty($contest)){
    		return FALSE;
    	}
    	 
    	return in_array($contest->status->name,['Preparation']);
    }
    
    public function manageNomination(User $user,Contest $contest){
    	$contest = $this->contests->getCurrent();
    	if(empty($contest)){
    		return FALSE;
    	}
    
    	return in_array($contest->status->name,['Nomination']);
    }
    
    public function manageScore(User $user,Contest $contest){
    	if(empty($contest)){
    		return FALSE;
    	}
    
    	return in_array($contest->status->name,['Ongoing']);
    }
}
