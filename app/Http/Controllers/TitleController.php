<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\ContestRepository;
use App\Title;
use App\LiveRank;
use App\Jury;
use App\Contestant;
use App\Score;



class TitleController extends Controller
{
	
	protected $contests;
	
	public function __construct(ContestRepository $contests){
		$this->middleware('auth');
		$this->contests = $contests;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$contest = $this->contests->getCurrent();
    	if(empty($contest)){
    		return redirect()->action('ContestController@index');
    	}
    	
    	$titles = Title::all();
    	
    	
    	$juryCount=Jury::where('contest_id',$contest->id)->count();
    	
    	$contestantCount = Contestant::where('contest_id',$contest->id)->where('nomination',TRUE)->count();
    	
    	$query = "SELECT id FROM juries WHERE contest_id=$contest->id";
    	$scoreCount = Score::whereRaw("jury_id IN ($query)")->where('valid',TRUE)->count();
    	

    	$message = NULL;
    	if(($juryCount * $contestantCount) == $scoreCount){
    		
    	}else{
    	 	$message = trans('app.title.cant_add_title');
    	}
    	
    	$liveRanks = LiveRank::where('rank',1)->where('contest_id',$contest->id)->orderBy('team_id')->get();
    	
    	$selectRank = [];
    	foreach ($liveRanks as $liveRank){
    		$selectRank[$liveRank->team->name][$liveRank->contestant_id] = $liveRank->contestant->tank_number .' - '.$liveRank->contestant->owner.' - '.$liveRank->subcategory->name;
    	}
    	
   		$contestants = Contestant::has('title')->where('contest_id',$contest->id)->get();
    	
    	
    	return view('title.index',compact(['contest','titles','selectRank','message','contestants']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	
    	//TODO nanti bro harusnya ambil dari contestant bro
    	$contest = $this->contests->getCurrent();
    	if(empty($contest)){
    		return redirect()->action('ContestController@index');
    	}
    	
    	$this->validate($request, [
    			'contestant_id' => 'required',
    			'title_id' => 'required',
    	]);
    	
    	$juryCount=Jury::where('contest_id',$contest->id)->count();
    	 
    	$contestantCount = Contestant::where('contest_id',$contest->id)->where('nomination',TRUE)->count();
    	 
    	$query = "SELECT id FROM juries WHERE contest_id=$contest->id";
    	$scoreCount = Score::whereRaw("jury_id IN ($query)")->where('valid',TRUE)->count();
    	 
    	
    	$message = NULL;
    	if(($juryCount * $contestantCount) == $scoreCount){
    	
    	}else{
    		return redirect()->action('TitleController@index')->withInput([
    			'type' => 'danger',
    			'content' => trans('app.title.cant_add_title')
    		]);
    	}
    	
    	$contestant_id = $request->input('contestant_id');
    	$title_id = $request->input('title_id');
    	
    	$liveRank = LiveRank::where('contestant_id',$contestant_id)->first();
    	
    	if($liveRank->rank != 1){
    		return redirect()->action('TitleController@index')->withInput([
    				'type' => 'danger',
    				'content' => trans('app.title.1st_only')
    		]);
    	}
    	
    	
    	$title_count = Contestant::where('contest_id',$contest->id)->where('title_id',$title_id)->count();
    	$title = Title::findOrFail($title_id);
    	if($title_count > 0){
    		return redirect()->action('TitleController@index')->withInput([
    				'type' => 'danger',
    				'content' => trans('app.title.title_exists',['name'=>$title->name])
    		]);
    	}
    	
    	
    	$contestant = Contestant::findOrFail($contestant_id);
    
    	
    	$contestant->title()->associate($title);
    	$contestant->save();
    	
    	
    	return redirect()->action('TitleController@index')->withInput([
    			'type' => 'info',
    			'content' => trans('app.alert.data.store')
    	]);
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
    public function destroy(Request $request,Contestant $contestant)
    {
    	$contest = $this->contests->getCurrent();
    	if(empty($contest)){
    		return redirect()->action('ContestController@index');
    	}
    	
    	$contestant->title()->dissociate();
    	$contestant->save();
    	return redirect()->action('TitleController@index')->withInput([
    			'type' => 'info',
    			'content' => trans('app.alert.data.destroy')
    	]);
    	
    }
}
