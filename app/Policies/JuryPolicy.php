<?php

namespace App\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use App\Jury;
use App\User;

class JuryPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function checkJury(User $user,Jury $jury){
    	
    	if(empty($jury)){
    		return FALSE;
    	}else{
    		return TRUE;
    	}
    	
    }
}
