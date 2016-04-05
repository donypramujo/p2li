<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Configuration;
use App\Contest;
use App\Repositories\ConfigurationRepository;


class ConfigController extends Controller
{
	
	protected $configs;
	
	public function __construct(ConfigurationRepository $configs){
		$this->middleware('auth');
		$this->configs = $configs;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$configurations = Configuration::all();

		$configs= [];
		foreach ($configurations as $configuration){
			$configs[$configuration->key] = $configuration->value; 
		}
		
		$contests =	Contest::all();
		
    	return view('configuration.index', compact('configs','contests'));
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
    	$this->validate ( $request, [
    			'max_score' => 'required|numeric',
    			'rate_penalty_minor' => 'required|numeric|between:0,100',
    			'rate_penalty_major' => 'required|numeric|between:0,100',
    			'contest' => 'required',
    	] );
    	
    	$max_score = $this->configs->getConfig('max_score');
    	$max_score->value = $request->input('max_score');
    	$max_score->save();
    	
    	$rate_penalty_minor = $this->configs->getConfig('rate_penalty_minor');
    	$rate_penalty_minor->value = $request->input('rate_penalty_minor');
    	$rate_penalty_minor->save();
    	
    	$rate_penalty_major = $this->configs->getConfig('rate_penalty_major');
    	$rate_penalty_major->value = $request->input('rate_penalty_major');
    	$rate_penalty_major->save();
    	
    	$contest = $this->configs->getConfig('contest');
    	$contest->value = $request->input('contest');
    	$contest->save();
    	
    	return redirect()->action('ConfigController@index')->withInput([
    			'type' => 'info',
    			'content' => trans('app.alert.data.update')
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
    public function destroy($id)
    {
        //
    }
}
