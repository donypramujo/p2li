<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Subcategory;
use App\Category;

class SubcategoryController extends Controller
{
	
	public function __construct(){
		$this->middleware('auth');
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	
    	$subcategory = Subcategory::paginate(config('pagination.limit'));
    	
    	return view('subcategory.index',[
    			'subcategories'=> $subcategory
    	]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$categories = Category::all();
    	return view('subcategory.create',compact('categories'));
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
    		'name' => 'required|unique:subcategories|max:20',
    		'category_id' => 'required',
    	] );
    	 
    	 
    	$subcategory = Subcategory::create($request->except('_token'));
    	$subcategory->save();
    	 
    	return redirect()->action('SubcategoryController@index')->withInput([
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Subcategory $subcategory)
    {
        //
    	$categories = Category::all();
    	return view('subcategory.edit')->with(compact(['subcategory','categories']));
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
    	$this->validate ( $request, [
    			'name' => "required|unique:subcategories,name,$subcategory->id|max:20",
    			'category_id' => 'required',
    	] );
    	
    	$subcategory->fill($request->except('_token'));
    	$subcategory->update();
    	
    	return redirect()->action('SubcategoryController@index')->withInput([
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
    public function destroy(Subcategory $subcategory)
    {
    	$subcategory->delete();
    	return redirect()->action('SubcategoryController@index')->withInput([
    			'type' => 'info',
    			'content' => trans('app.alert.data.destroy')
    	]);;
    }
}
