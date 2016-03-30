<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Team;

class TeamController extends Controller
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
    	
		$team = Team::sortable()->paginate(config('pagination.limit'));
		
		$team->appends($request->except('page'));
		
    	return view('team.index',[
    		'teams'=> $team
    	]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('team.create');
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
				'name' => 'required|unique:teams|max:50' 
		] );
		
		$team = new Team ();
		$team->name = $request->input ( 'name' );
		$team->save ();
		
		return redirect()->action('TeamController@index')->withInput([
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
    public function edit(Request $request,Team $team)
    {
    	return view('team.edit')->with(compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Team $team)
    {
    	$this->validate ( $request, [
    			'name' => "required|unique:teams,name,$team->id|max:50" 
    	] );
    	
    	
    	$team->name = $request->input('name');
        $team->update();
        return redirect()->action('TeamController@index')->withInput([
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
    public function destroy(Request $request,Team $team)
    {
    	$team->delete();
    	return redirect()->action('TeamController@index')->withInput([
        			'type' => 'info',
        			'content' => trans('app.alert.data.destroy')
        ]);;
    	
    }
}
