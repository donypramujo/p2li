<?php

namespace App\Http\Controllers;


use App\LiveScore;
use App\Repositories\ConfigurationRepository;
use Illuminate\Http\Request;
use App\Contest;
use App\Subcategory;
use App\Score;
use App\Contestant;
use App\LiveTeamScore;
use Kenarkose\Tracker\SiteView;

class HomeController extends Controller
{
    
	protected $configs;
	
	public function __construct(ConfigurationRepository $configs){
		$this->configs = $configs;
	}
    
	public function index(Request $request){
		
		$contest_id = $this->configs->get('contest');
		
		$contest = Contest::findOrFail($contest_id);
		$subcategory_id = $request->input('subcategory_id');
		
		$query = "SELECT subcategory_id FROM contestants WHERE contest_id =$contest->id GROUP BY subcategory_id";
		$subcategories = Subcategory::whereRaw("id IN ($query)")->orderBy('category_id','asc')->with('category')->get();
		$select_subcategories = [];
		foreach ($subcategories as $subcategory){
			$select_subcategories[$subcategory->category->name][$subcategory->id] = $subcategory->name;
		}
		
		
		$liveScores = NULL;
		$subcategory = NULL;
		if(!empty($subcategory_id)){
			$liveScores  =LiveScore::where('subcategory_id',$subcategory_id)->where('contest_id',$contest->id)->get();
			$subcategory = Subcategory::findOrFail($subcategory_id);
			
		}
		
		$contestants = Contestant::has('title')->where('contest_id',$contest->id)->orderBy('title_id')->get();
		
		$visitor = SiteView::all()->count();
		
		
		return view('home.index',compact(['liveScores','contest','select_subcategories','subcategory','contestants','visitor']));
	}
	
	public function show(Contestant $contestant){
		$scores = Score::where('contestant_id',$contestant->id)->get();
		
		return view('home.show',compact(['scores','contestant']));
	}
	
	public function showLiveTeamScores(){
		$contest_id = $this->configs->get('contest');
		$contest = Contest::findOrFail($contest_id);
		
		$scores = LiveTeamScore::where('contest_id',$contest_id)->get();
		
		return view('home.live_team_scores',compact(['scores','contest']));
		
	}
}
