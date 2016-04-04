<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Repositories\ContestRepository;
use App\Repositories\StatusRepository;
use App\Jury;
use function League\Flysystem\get;


class JuryController extends Controller
{
	
	protected $contests;
	
	public function __construct(ContestRepository $contests,StatusRepository $statuses){
		$this->middleware('auth');
		$this->contests = $contests;
		$this->statuses = $statuses;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        
    	$contest = $this->contests->getCurrent();
//     	if(empty($contest)){
//     		return redirect()->action('ContestController@index');
//     	}else if($contest->status->name == 'Ongoing'){
//     		return redirect()->action('ContestController@index')->withInput([
//     				'type' => 'info',
//     				'content' => trans('app.jury.register_not_allowed')
//     		]);
//     	}
    	
    	$users = User::whereHas('roles', function($query){
			$query->where('name','jury');
		})->get();
		
    	
    	$juries = Jury::whereHas('contest',function($query) use($contest){
    		$query->where('id',$contest->id);
    	})->get();
    	
    	return view('jury.index',compact(['users','contest','juries']));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$contest = $this->contests->getCurrent();
    	$this->authorize('manageJury',$contest);
    	$this->validate($request, [
    			'user_id' => "required|unique:juries,user_id,NULL,id,contest_id,$contest->id"
    	]);
    	
    	
    	$jury = new Jury();
    	
    	$user = User::find($request->input('user_id'));
    	$jury->user()->associate($user);
    	$jury->contest()->associate($contest);
    	
    	$jury->save();
    	
    	
    	return redirect()->action('JuryController@index')->withInput([
    			'type' => 'info',
    			'content' => trans('app.jury.success_register')
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jury $jury)
    {
    	$contest = $this->contests->getCurrent();
    	$this->authorize('manageJury',$contest);
    	
    	
    	$jury->delete();
    	 
    	return redirect()->action('JuryController@index')->withInput([
    			'type' => 'info',
    			'content' => trans('app.jury.success_unregister')
    	]);
    }
}
