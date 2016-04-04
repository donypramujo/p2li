<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Mail;


class UserController extends Controller
{
   
	public function __construct(){
		$this->middleware('auth');
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	
		$user = User::whereHas('roles', function($query){
			$query->whereIn('name',['admin','jury']);
		})->paginate(config('pagination.limit'));
		
		
		$user->appends($request->except('page'));
		
    	return view('user.index',[
    		'users'=> $user
    	]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		$this->validate ( $request, [ 
				'name' => 'required|max:255',
				'email' => 'required|email|unique:users|max:255',
				'role_id' => 'required|in:2,3',
				'password' => 'required|confirmed|min:6',
		] );
		
		$user = new User();
		$user->name = $request->input ( 'name' );
		$user->email = $request->input ( 'email' );
		$user->password = bcrypt($request->input('password'));
		$user->save ();
		
		$role = Role::find($request->input('role_id'));
		
		$user->attachRole($role);
		
		Mail::send('mails.user_create',$request->all(),function($message) use ($request){
			$message->to($request->input('email'));
			$message->subject(trans('app.user.create_notification'));
		});
		
		
		return redirect()->action('UserController@index')->withInput([
        			'type' => 'info',
        			'content' => trans('app.alert.data.store')
        ]);;
	}

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,User $user)
    {
    	return view('user.edit')->with(compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
    	$this->validate ( $request, [
    			'name' => 'required|max:255',
    			'email' => "required|email|unique:users,email,$user->id|max:255",
    			'role_id' => 'required|in:2,3',
    			'password' => 'required|confirmed|min:6',
    	] );
    	
    	
    	$user->name = $request->input ( 'name' );
    	$user->email = $request->input ( 'email' );
    	$user->password = bcrypt($request->input('password'));
    	$role = Role::find($request->input('role_id'));
    	$user->roles()->detach();
    	$user->roles()->attach($role);
        $user->update();
        
        Mail::send('mails.user_edit',$request->all(),function($message) use ($request){
        	$message->to($request->input('email'));
        	$message->subject(trans('app.user.edit_notification'));
        });
        
        return redirect()->action('UserController@index')->withInput([
        			'type' => 'info',
        			'content' => trans('app.alert.data.update')
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,User $user)
    {
    	$user->delete();
    	return redirect()->action('UserController@index')->withInput([
        			'type' => 'info',
        			'content' => trans('app.alert.data.destroy')
        ]);;
    	
    }
}
