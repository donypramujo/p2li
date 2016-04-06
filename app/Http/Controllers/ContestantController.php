<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Subcategory;
use App\Team;
use App\Contest;
use App\Contestant;
use App\Repositories\ContestRepository;

class ContestantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
	
	protected $contests;
	
	public function __construct(ContestRepository $contests){
		$this->middleware('auth');
		$this->contests = $contests;
	}
	
    public function index(Request $request)
    {
    	$contest = $this->contests->getCurrent();
    	if(empty($contest)){
    		return redirect()->action('ContestController@index');
    	};
    	$categories = Category::orderBy('id','asc')->with('subcategories')->get();
    	$teams = Team::all();
    	
    	
    	$contestants = NULL;
		$search_field = $request->input ( 'search_field' );
		$search_value = $request->input ( 'search_value' );
		
		if ($search_field == 'subcategory') {
			$contestants = Contestant::whereHas ( 'subcategory', function ($query) use ($search_value) {
				$query->where ( 'name', 'LIKE', "%$search_value%" );
			} )->where('contest_id',$contest->id)->sortable ()->paginate ( config ( 'pagination.limit' ) );
		} else if ($search_field == 'team') {
			
			$contestants = Contestant::whereHas ( 'team', function ($query) use ($search_value) {
				$query->where ( 'name', 'LIKE', "%$search_value%" );
			})->where('contest_id',$contest->id)->sortable ()->paginate ( config ( 'pagination.limit' ) );
			
		} else if ($search_field == 'tank_number') {
			$contestants = Contestant::where ( 'tank_number', $search_value )->sortable ()->where('contest_id',$contest->id)->paginate ( config ( 'pagination.limit' ) );
		} else {
			$contestants = Contestant::where('contest_id',$contest->id)->sortable ()->paginate ( config ( 'pagination.limit' ) );
		}
    	
    	if(!empty($contestants)){
    		$contestants->appends($request->except('page'));
    	}
    	
    	return view('contestant.index',compact(['categories','teams','contestants','search_field','search_value','contest']));
    }
    
    
    public function showCategoryForm(){
    	
    
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
    	$contest = $this->contests->getCurrent();
    	$this->authorize('manageContestant',$contest);
    	 
    	$this->validate($request, [
    			'subcategory_id' => 'required',
    			'team_id' => 'required',
    			'tank_number' => "required|numeric|unique:contestants,tank_number,NULL,id,contest_id,$contest->id"
    	]);
    	
    	
    	$contestant = new Contestant();
    	
    	$subcategory = Subcategory::findOrFail($request->input('subcategory_id'));
    	
    	$team = Team::findOrFail($request->input('team_id'));
    	
    	$contestant->subcategory()->associate($subcategory);
    	$contestant->team()->associate($team);
    	$contestant->contest()->associate($contest);
    	
    	$contestant->tank_number = $request->input('tank_number');
    	$contestant->save();
    	
    	return redirect()->action('ContestantController@index')->withInput([
    			'type' => 'info',
    			'content' => trans('app.contestant.success_register')
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Contestant $contestant)
    {
    	$categories = Category::orderBy('id','asc')->with('subcategories')->get();
    	$teams = Team::all();
    	$contest = $this->contests->getCurrent();
    	 
    	return view('contestant.edit',compact(['categories','teams','contestant','contest']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contestant $contestant)
    {
    	$contest = $this->contests->getCurrent();
    	$this->authorize('manageContestant',$contest);
    	
    	
    	$this->validate($request, [
    			'subcategory_id' => 'required',
    			'team_id' => 'required',
    			'tank_number' => "required|numeric|unique:contestants,tank_number,$contestant->id,id,contest_id,$contest->id"
    	]);
    	 
    	 
    	 
    	$subcategory = Subcategory::findOrFail($request->input('subcategory_id'));
    	 
    	$team = Team::findOrFail($request->input('team_id'));
    	 
    	$contestant->subcategory()->associate($subcategory);
    	$contestant->team()->associate($team);
    	$contestant->contest()->associate($contest);
    	 
    	$contestant->tank_number = $request->input('tank_number');
    	$contestant->update();
    	 
    	return redirect()->action('ContestantController@index')->withInput([
    			'type' => 'info',
    			'content' => trans('app.contestant.success_register')
    	]);;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contestant $contestant)
    {
    	$contest = $this->contests->getCurrent();
    	$this->authorize('manageContestant',$contest);
    	
    	

    	$contestant->delete();
    	
    	return redirect()->action('ContestantController@index')->withInput([
    			'type' => 'info',
    			'content' => trans('app.contestant.success_unregister')
    	]);
    }
}
