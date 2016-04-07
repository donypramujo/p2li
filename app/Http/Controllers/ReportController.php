<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contest;
use App\Category;
use App\LiveScore;
use App\Subcategory;
use App\Score;
use App\LiveTeamScore;
use App\Team;
use App\LiveRank;


class ReportController extends Controller
{
	
	
	public function __construct(){
		$this->middleware('auth');
	}
	
	public function filterScore(Request $request){
		$contests =	Contest::all();
		$categories = Category::all();
		return view('report.filter_score',compact(['contests','categories']));
	}
	
	public function printScore(Request $request){
		$subcategory_id = $request->input('subcategory_id');
		$contest_id = $request->input('contest_id');
		$contest = Contest::findOrFail($contest_id);
		$subcategory = Subcategory::findOrFail($subcategory_id);
		$liveScores = LiveScore::where('contest_id',$contest_id)->where('subcategory_id',$subcategory_id)->get();
		return view('report.print_score',compact(['liveScores','contest','subcategory']));
	}
	
	public function filterScoreByTeam(Request $request){
		$contests =	Contest::all();
		$teams = Team::all();
		return view('report.filter_score_by_team',compact(['contests','teams']));
	}
	
	public function printScoreByTeam(Request $request){
		$contest_id = $request->input('contest_id');
		$team_id = $request->input('team_id');
		$contest = Contest::findOrFail($contest_id);
		$team = Team::findOrFail($team_id);
		$liveRanks = LiveRank::where('contest_id',$contest_id)->where('team_id',$team_id)->get();
		return view('report.print_score_by_team',compact(['liveRanks','contest','team']));
	}
	
	public function filterScoreDetail(Request $request){
		$contests =	Contest::all();
		$categories = Category::all();
		return view('report.filter_score_detail',compact(['contests','categories']));
	}
	
	public function printScoreDetail(Request $request){
		$subcategory_id = $request->input('subcategory_id');
		$contest_id = $request->input('contest_id');
		$contest = Contest::findOrFail($contest_id);
		$subcategory = Subcategory::findOrFail($subcategory_id);
		
		
		$scores = Score::whereHas('contestant',function($query) use($subcategory,$contest){
    		$query->where('subcategory_id',$subcategory->id)->where('contest_id',$contest->id)->where('nomination',TRUE);
    	})->get();
    	
		
		$scores = collect ( $scores )->sortBy ( function ($score) {
			return $score->contestant->tank_number;
		});
		
		return view('report.print_score_detail',compact(['scores','contest','subcategory']));
	}
	
	public function filterScoreDetailByTeam(Request $request){
		$contests =	Contest::all();
		$teams = Team::all();
		return view('report.filter_score_detail_by_team',compact(['contests','teams']));
	}
	
	public function printScoreDetailByTeam(Request $request){
		$team_id = $request->input('team_id');
		$contest_id = $request->input('contest_id');
		$contest = Contest::findOrFail($contest_id);
		$team = Team::findOrFail($team_id);
	
	
		$scores = Score::whereHas('contestant',function($query) use($team,$contest){
			$query->where('team_id',$team->id)->where('contest_id',$contest->id)->where('nomination',TRUE);
		})->get();
		 
	
		$scores = collect ( $scores )->sortBy ( function ($score) {
			return $score->contestant->tank_number;
		});
	
			return view('report.print_score_detail_by_team',compact(['scores','contest','team']));
	}
	
	
	public function filterTeamScore(Request $request){
		$contests =	Contest::all();
		return view('report.filter_team_score',compact(['contests']));
	}
	
	public function printTeamScore(Request $request){
		$contest_id = $request->input('contest_id');
		$contest = Contest::findOrFail($contest_id);
		$scores = LiveTeamScore::where('contest_id',$contest_id)->get();
		return view('report.print_team_score',compact(['scores','contest']));
	}
}
