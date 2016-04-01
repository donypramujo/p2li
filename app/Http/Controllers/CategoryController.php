<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
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
    	
		$category = Category::paginate(config('pagination.limit'));
		
    	return view('category.index',[
    		'categories'=> $category
    	]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	return view('category.create');
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
    			'name' => 'total_rate|required|unique:categories|max:20',
    			'rate_overall_impression' => 'required|numeric|between:0,100',
    			'rate_head' => 'required|numeric|between:0,100',
    			'rate_face' => 'required|numeric|between:0,100',
    			'rate_body_shape' => 'required|numeric|between:0,100',
    			'rate_marking' => 'required|numeric|between:0,100',
    			'rate_pearl' => 'required|numeric|between:0,100',
    			'rate_color' => 'required|numeric|between:0,100',
    			'rate_finnage' => 'required|numeric|between:0,100',
    	] );
    	
    	
    	$category = Category::create($request->except('_token'));
    	$category->save();
    	
    	return redirect()->action('CategoryController@index')->withInput([
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
    public function edit(Request $request,Category $category)
    {
    	return view('category.edit')->with(compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Category $category)
    {

    	$this->validate ( $request, [
    			'name' => "total_rate|required|unique:categories,name,$category->id|max:20",
    			'rate_overall_impression' => 'required|numeric|between:0,100',
    			'rate_head' => 'required|numeric|between:0,100',
    			'rate_face' => 'required|numeric|between:0,100',
    			'rate_body_shape' => 'required|numeric|between:0,100',
    			'rate_marking' => 'required|numeric|between:0,100',
    			'rate_pearl' => 'required|numeric|between:0,100',
    			'rate_color' => 'required|numeric|between:0,100',
    			'rate_finnage' => 'required|numeric|between:0,100',
    	] );
    	 
    	$category->fill($request->except('_token'));
    	$category->update();
    	 
        return redirect()->action('CategoryController@index')->withInput([
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
    public function destroy(Request $request,Category $category)
    {
    	$category->delete();
    	return redirect()->action('CategoryController@index')->withInput([
    			'type' => 'info',
    			'content' => trans('app.alert.data.destroy')
    	]);;
        
    }
}
