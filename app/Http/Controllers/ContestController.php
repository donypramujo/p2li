<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ContestRepository;
use App\Repositories\StatusRepository;
use App\Contest;
use Carbon\Carbon;


class ContestController extends Controller
{
	
	
	protected $contests;
	
	protected $statuses;
	
	
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
    public function index(Request $request)
    {
        //
        
    	$contest = $this->contests->getCurrent();
    	
    	if(empty($contest)){
    		return redirect()->action('ContestController@create')->withInput($request->old());
    	}else{
    		// TODO
    		
    		
    	}
        
    	return view('contest.index',compact('contest'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Contest $contest)
    {
    	$contest = new Contest();
    	$this->authorize('store',$contest);
    	
    	return view('contest.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$contest = new Contest();
    	$this->authorize('store',$contest);
    	
    	$this->validate($request, [
    			'name' => 'required|unique:contests|max:50',
    			'start_date' => 'required|date_format:d-m-Y',
    			'end_date' => 'required|date_format:d-m-Y|after:start_date',
    	]);
    	

    	$start_date = Carbon::createFromFormat('d-m-Y', $request->input('start_date'));
    	$end_date = Carbon::createFromFormat('d-m-Y', $request->input('end_date'));
    	
    	$contest->name = $request->input('name');
    	$contest->start_date = $start_date;
    	$contest->end_date = $end_date;
    	$preparation = $this->statuses->preparation();
    	$contest->status()->associate($preparation);
    	
    	$contest->save();
    	
    	return redirect()->action('ContestController@index')->withInput([
    			'type' => 'info',
    			'content' => trans('app.contest.success_create')
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
    public function update(Request $request, Contest $contest)
    {
    	
    	
    	$this->authorize('update',$contest);
    	$status = $this->statuses->completed();
    	
    	if($contest->status->name == trans('app.status.preparation')){
    		$status = $this->statuses->nomination();
    	}else if($contest->status->name == trans('app.status.nomination')){
    		$status = $this->statuses->ongoing();
    	}
    	
    	
    	$contest->status()->associate($status);
    	$contest->save();
    	
    	return redirect()->action('ContestController@index')->withInput([
    			'type' => 'info',
    			'content' => trans('app.contest.success_change_status')
    	]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contest $contest)
    {
    	
    	$this->authorize('destroy',$contest);
    	
    	$status = $this->statuses->canceled();
    	$contest->status()->associate($status);
    	$contest->save();
    	return redirect()->action('ContestController@index')->withInput([
    			'type' => 'info',
    			'content' => trans('app.contest.success_cancel')
    	]);
    }
}
