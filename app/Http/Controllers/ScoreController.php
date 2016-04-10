<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;
use App\Contestant;
use App\Jury;
use App\Repositories\ContestRepository;
use App\Repositories\JuryRepository;
use App\Score;
use App\Subcategory;
use App\Repositories\ConfigurationRepository;
use Illuminate\Support\Facades\DB;

class ScoreController extends Controller
{
	
	protected $contests;
	protected $juries;
	protected $configs;
	
	public function __construct(ContestRepository $contests,JuryRepository $juries,ConfigurationRepository $configs){
		$this->middleware('auth');
		$this->contests = $contests;
		$this->juries = $juries;
		$this->configs = $configs;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contest = $this->contests->getCurrent();
        $jury = $this->juries->getJury($contest);
        
        $this->authorize('manageScore',$contest);
		$this->authorize('checkJury',$jury);        
		
		
		$query = "SELECT subcategory_id FROM contestants WHERE contest_id =$contest->id GROUP BY subcategory_id";
		
		$subcategories = Subcategory::whereRaw("id IN ($query)")->orderBy('category_id','asc')->with('category')->get();
		
		
		$select_subcategories = [];
		
		foreach ($subcategories as $subcategory){
			$select_subcategories[$subcategory->category->name][$subcategory->id] = $subcategory->name; 
		}
		
		
		
    	return view('score.index',compact(['subcategories','select_subcategories']));
    }
    
    
    public function emptyScore($contestant,$jury){
    	
    	$score = new Score();
    	
    	$score->rate_overall_impression = 0;
    	$score->rate_head = 0;
    	$score->rate_face = 0;
    	$score->rate_body_shape = 0;
    	$score->rate_marking = 0;
    	$score->rate_pearl = 0;
    	$score->rate_color = 0;
    	$score->rate_finnage = 0;
    	$score->rate_penalty = 0;
    	
    	$score->penalty_type='';
    	
    	$score->valid = FALSE;
    	
    	$score->contestant()->associate($contestant);
    	$score->jury()->associate($jury);
    	return $score;
    }
    
    public function calculateScore(){
    	
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
    	$contest = $this->contests->getCurrent();
    	$jury = $this->juries->getJury($contest);
    	
    	$this->authorize('manageScore',$contest);
    	$this->authorize('checkJury',$jury);
    	
    	$subcategory = Subcategory::findOrFail($request->input('subcategory_id'));
    	
    	$contestants = Contestant::where('subcategory_id',$subcategory->id)->where('contest_id',$contest->id)->where('nomination',TRUE)->get();
    	
    	$scores = [];
    	
    	
    	foreach ($contestants as $contestant){
    		
    		
    		$score = Score::where('contestant_id',$contestant->id)->where('jury_id',$jury->id)->first();
    		
    		if(empty($score)){
    			$score = $this->emptyScore($contestant,$jury);
    		}
    		
    		
    		$scores[] = $score;
    	}
    	
    	$scores = collect($scores)->sortBy(function($score){
    		return $score->contestant->tank_number;
    	});
    	
    	
    	return view('score.create',compact('subcategory','scores'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    	$contest = $this->contests->getCurrent();
    	$jury = $this->juries->getJury($contest);
    	 
    	$this->authorize('manageScore',$contest);
    	$this->authorize('checkJury',$jury);
    	
    	$input_name = $request->input('name');
    	
    	
    	if(in_array($input_name,['penalty_type','comment'])){
    		$this->validate ( $request, [
    				'pk' => 'required',
    				'name' => 'required'
    		]);
    		
    	}else{
    		$this->validate ( $request, [
    				'pk' => 'required',
    				'name' => 'required',
    				'value' => 'required|numeric|between:0,100',
    		]);
    		
    	}
    	
    	
    	$contestant = Contestant::findOrFail($request->input('pk'));
    	
    	
    	$subcategory = Subcategory::findOrFail($contestant->subcategory_id);
    	
    	$score = Score::where('contestant_id',$contestant->id)->where('jury_id',$jury->id)->first();

    	if (empty ( $score )) {
			$score = $this->emptyScore ( $contestant, $jury );
		}
		
		$input_name = $request->input('name');
		$max_score = doubleval($this->configs->get('max_score'));
		
		if($input_name == 'penalty_type'){
			$rate_penalty = 0;
			$score->penalty_type = $request->input('value');
			if($score->penalty_type == 'minor'){
				$rate_penalty = doubleval($this->configs->get('rate_penalty_minor'));
			}else if($score->penalty_type == 'major'){
				$rate_penalty = doubleval($this->configs->get('rate_penalty_major'));
			}
			
			$penalty = $score->rate_penalty;
			$score_final = collect([
					$score->score_overall_impression,
					$score->score_head,
					$score->score_face,
					$score->score_body_shape,
					$score->score_marking,
					$score->score_pearl,
					$score->score_color,
					$score->score_finnage,
						
			])->sum();
			$score_penalty = ($penalty/doubleval(100)) * (($rate_penalty*$score_final)/doubleval(100));
			
			$score->fill([
					'score_penalty' => $score_penalty
			]);
			$score_final = $score_final - $score->score_penalty;

			$score->score_final = $score_final;
			if(!$score->valid){
				$score->save();
			}
			return;
		}
		
		if($input_name == 'comment'){
			$score->fill([
					$request->input('name') => $request->input('value'),
			]);
			if(!$score->valid){
				$score->save();
			}
			return;
		}
		
		
		
		if($input_name == 'penalty'){
			$rate_penalty = 0;
			if($score->penalty_type == 'minor'){
				$rate_penalty = doubleval($this->configs->get('rate_penalty_minor'));
			}else if($score->penalty_type == 'major'){
				$rate_penalty = doubleval($this->configs->get('rate_penalty_major'));
			}
			
			$penalty = doubleval($request->input('value'));
			
			$score_final = collect([
					$score->score_overall_impression,
					$score->score_head,
					$score->score_face,
					$score->score_body_shape,
					$score->score_marking,
					$score->score_pearl,
					$score->score_color,
					$score->score_finnage,
						
			])->sum();
			
			$score_penalty = ($penalty/doubleval(100)) * (($rate_penalty*$score_final)/doubleval(100));
			
			$score->fill([
					'rate_penalty'=> $penalty,
					'score_penalty' => $score_penalty
			]);
			$score_final = $score_final - $score->score_penalty;

			$score->score_final = $score_final;
			if(!$score->valid){
				$score->save();
			}
			return;
		}
		
		$name ='rate_'.$request->input('name');
		
		$value = doubleval($request->input('value'));
		
		$rate = doubleval($subcategory->category->$name);
		
		$score_value = ($value/doubleval(100)) * (($rate* $max_score) / doubleval(100));
		
		
		$score_name ='score_'.$request->input('name');
		
		
		$score->fill([
				$name => $value,
				$score_name => $score_value
		]);
		
		$score_final = collect([
				$score->score_overall_impression,
				$score->score_head,
				$score->score_face,
				$score->score_body_shape,
				$score->score_marking,
				$score->score_pearl,
				$score->score_color,
				$score->score_finnage,
		
		])->sum();
			
		$rate_penalty = 0;
		if($score->penalty_type == 'minor'){
			$rate_penalty = doubleval($this->configs->get('rate_penalty_minor'));
		}else if($score->penalty_type == 'major'){
			$rate_penalty = doubleval($this->configs->get('rate_penalty_major'));
		}
		
		$penalty = $score->rate_penalty;
		
		
		$score_penalty = ($penalty/doubleval(100)) * (($rate_penalty*$score_final)/doubleval(100));
    	
		$score_final = $score_final - $score_penalty;
		
		$score->score_final = $score_final;
		$score->score_penalty = $score_penalty;
		
		
		if(!$score->valid){
			$score->save();
		}
		
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Subcategory $subcategory)
    {
    	
    	$contest = $this->contests->getCurrent();
    	$jury = $this->juries->getJury($contest);
    	
    	$this->authorize('manageScore',$contest);
    	$this->authorize('checkJury',$jury);
    	
    	$scores = Score::whereHas('contestant',function($query) use($subcategory,$contest){
    		$query->where('subcategory_id',$subcategory->id)->where('contest_id',$contest->id)->where('nomination',TRUE);
    	})->where('jury_id',$jury->id)->get();
    	
    	
    	$scores = $scores->sortBy(function($score){
    		return $score->contestant->tank_number;
    	});
    	
    	
    	return view('score.show',compact(['scores','subcategory']));
    	
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
    public function update(Request $request, Subcategory $subcategory)
    {
    	$contest = $this->contests->getCurrent();
    	$jury = $this->juries->getJury($contest);
    	
    	$this->authorize('manageScore',$contest);
    	$this->authorize('checkJury',$jury);
    	
    	$scores = Score::whereHas('contestant',function($query) use($subcategory,$contest){
    		$query->where('subcategory_id',$subcategory->id)->where('contest_id',$contest->id)->where('nomination',TRUE);
    	})->where('jury_id',$jury->id)->get();
    	
    	
    	foreach ($scores  as $score){
    		$score->valid = TRUE;
    		$score->update();
    	}
    	
    	return redirect()->action("ScoreController@create",[
    			'subcategory_id' => $subcategory->id
    	])->withInput([
    			'type' => 'info',
    			'content' => trans('app.score.success_validate')
    	]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
