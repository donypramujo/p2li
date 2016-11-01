<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Breeder;

class BreederController extends Controller
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
    	
    	$breeder = Breeder::sortable()->paginate(config('pagination.limit'));
		
		$breeder->appends($request->except('page'));
		
    	return view('breeder.index',[
    		'breeders'=> $breeder
    	]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('breeder.create');
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
				'name' => 'required|unique:breeders|max:50' 
		] );
		
		$breeder = new Breeder();
		$breeder->name = $request->input ( 'name' );
		$breeder->save ();
		
		return redirect()->action('BreederController@index')->withInput([
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
    public function edit(Request $request,Breeder $breeder)
    {
    	return view('breeder.edit')->with(compact('breeder'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Breeder $breeder)
    {
    	$this->validate ( $request, [
    			'name' => "required|unique:breeders,name,$breeder->id|max:50" 
    	] );
    	
    	
    	$breeder->name = $request->input('name');
    	$breeder->update();
        return redirect()->action('BreederController@index')->withInput([
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
    public function destroy(Request $request,Breeder $breeder)
    {
    	$breeder->delete();
    	return redirect()->action('BreederController@index')->withInput([
        			'type' => 'info',
        			'content' => trans('app.alert.data.destroy')
        ]);;
    	
    }
}
