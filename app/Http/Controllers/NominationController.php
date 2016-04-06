<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Repositories\ContestRepository;
use App\Contestant;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use App\Contest;

class NominationController extends Controller
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
    public function index(Request $request)
    {
    	$contest = $this->contests->getCurrent();
    	if(empty($contest)){
    		return redirect()->action('ContestController@index');
    	};
    	 
    	$search_field = $request->input ( 'search_field' );
    	$search_value = $request->input ( 'search_value' );
    	$query = NULL;
    	if ($search_field == 'subcategory') {
    		$query = Contestant::whereHas ( 'subcategory', function ($query) use ($search_value) {
    			$query->where ( 'name', 'LIKE', "%$search_value%" );
    		} );
    	} else if ($search_field == 'team') {
    			
    		$query = Contestant::whereHas ( 'team', function ($query) use ($search_value) {
    			$query->where ( 'name', 'LIKE', "%$search_value%" );
    		});
    			
    	} else if ($search_field == 'tank_number') {
    		$query = Contestant::where ( 'tank_number', $search_value );
    	} else {
    		$query = Contestant::sortable();
    	}
    	
    	$contestants = $query->sortable()->where('contest_id',$contest->id)->where('nomination',TRUE)->paginate ( config ( 'pagination.limit' ) );
    	 
    	if(!empty($contestants)){
    		$contestants->appends($request->except('page'));
    	}
    	 
    	return view('nomination.index',compact(['contestants','search_field','search_value','contest']));
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
    	$this->authorize('manageNomination',$contest);
    	
    	$this->validate($request, [
    			'tank_number' => "required|numeric",
    	]);
    	
    	$tank_number = $request->input('tank_number');
    	
    	
    	$contestant = Contestant::where('tank_number',$tank_number)->where('contest_id',$contest->id)->first();
    	
    	if(empty($contestant)){
    		
    		return redirect()->action('NominationController@index')->withInput([
    			'type' => 'danger',
    			'content' => trans('app.contestant.not_found'),
    			'tank_number' => $tank_number
    		]);
    		
    	}else if($contestant->nomination){ 
    		return redirect()->action('NominationController@index')->withInput([
    				'type' => 'danger',
    				'content' => trans('app.contestant.already_nominate'),
    				'tank_number' => $tank_number
    		]);
    	}
    		
    	
    	
    	$count = DB::table('contestants')->where('nomination',TRUE)->where('contest_id',$contest->id)->where('subcategory_id',$contestant->subcategory_id)->count();
    	
    	
    	if($count < 10){
    		$contestant->nomination = TRUE;
    		$contestant->save();
    		return redirect()->action('NominationController@index')->withInput([
    				'type' => 'info',
    				'content' => trans('app.contestant.success_nominate')
    		]);
    	}else{
    		return redirect()->action('NominationController@index')->withInput([
    				'type' => 'danger',
    				'content' => trans('app.contestant.failed_nominate')
    		]);
    		
    	}
    	
    		
    	
    	
    	
    
    	 
    }
    
    
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
    	$contest = $this->contests->getCurrent();
    	if(empty($contest)){
    		return redirect()->action('ContestController@index');
    	};
    	
    	$search_field = $request->input ( 'search_field' );
    	$search_value = $request->input ( 'search_value' );
    	
    	$query = NULL;
    	if ($search_field == 'subcategory') {
    		$query = Contestant::whereHas ( 'subcategory', function ($query) use ($search_value) {
    			$query->where ( 'name', 'LIKE', "%$search_value%" );
    		} );
    	} else if ($search_field == 'team') {
    		 
    		$query = Contestant::whereHas ( 'team', function ($query) use ($search_value) {
    			$query->where ( 'name', 'LIKE', "%$search_value%" );
    		});
    			 
    	} else if ($search_field == 'tank_number') {
    		$query = Contestant::where ( 'tank_number', $search_value );
    	} else {
    		$query = new Contestant();
    	}
    	 
    	$contestants = $query->where('contest_id',$contest->id)->where('nomination',TRUE)->get();
    	
    	
    	return view('nomination.show',compact(['contestants','contest']));
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
    public function destroy(Contestant $contestant)
    {
    	$contest = $this->contests->getCurrent();
    	$this->authorize('manageNomination',$contest);
    	
    	
    	
    	$contestant->nomination = FALSE;
    	$contestant->update();
    	
    	return redirect()->action('NominationController@index')->withInput([
    			'type' => 'info',
    			'content' => trans('app.contestant.success_denominate')
    	]);
    }
}
