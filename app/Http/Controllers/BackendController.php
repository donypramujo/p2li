<?php

namespace App\Http\Controllers;



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BackendController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.index');
    }
    
    
    public function showChangePasswordForm(){
    	
    	return view('backend.auth.passwords.change');
    }
    
    public function changePassword(Request $request){
    	$this->validate($request, [
            'password' => 'required|confirmed|min:6',
    		'old_password' => 'required|min:6',
        ]);
    	
    	
    	$user = Auth::user();
    	$credentials = [
    			'email' => $user->email,
    			'password' => $request->get('old_password'),
    	];
    	
    	if(Auth::validate($credentials)) {
    		
    		$user->password =  bcrypt($request->input('password'));
    		$user->save();
    		return redirect()->action('BackendController@showChangePasswordForm')->withInput([
    		        	'type' => 'info',
    		        	'content' => trans('app.alert.data.update')
    		]);
    	}
    	
    	return redirect()->back()->withInput([
    		        	'type' => 'danger',
    		        	'content' => trans('app.wrong_old_password')
    	]);
    	
    	
    }
}
