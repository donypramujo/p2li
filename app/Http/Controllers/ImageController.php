<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Intervention\Image\Facades\Image;
use App\Repositories\ContestRepository;
use App\Contestant;

class ImageController extends Controller
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
        
    	return view('image.index',compact(['contestants','search_field','search_value','contest']));
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
    	
    	$this->validate($request, [
    		'image' => 'image|max:1024'
    	]);
    	$id = $request->input('id');
    	
    	$contestant = Contestant::findOrFail($id);
    	
    	
    	$file_name = $request->file('image')->getClientOriginalName();
    	
    	$tmp = explode('.', $file_name);
    	$ext = end($tmp);
    	
    	
    	$pathname = $request->file('image')->getPathname();
    	
    	$image = Image::make($pathname);
    
    	
    	$image->save(config('image.contestant_path').$id.'.'.$ext);
    	$image->resize(160,120)->save(config('image.contestant_resize_path').$id.'.'.$ext);
    	
    	
    	
    	$img =\App\Image::where('file_name',$id.'.'.$ext)->first();
    	
    	if(empty($img)){
    		$img = new \App\Image();
    	}
    	$img->path = config('image.contestant_path');
    	$img->mime_type = $request->file('image')->getMimeType();
    	$img->file_name = $id.'.'.$ext;
    	
    	$img->save();
    	
    	$contestant->image()->associate($img);
    	
    	$contestant->save();
    	
    	return redirect()->action('ImageController@index')->withInput([
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
    public function show(Contestant $contestant)
    {
    	$contest = $this->contests->getCurrent();
    	if(empty($contest)){
    		return redirect()->action('ContestController@index');
    	};
    	
    	return view('image.show',compact('contestant'));
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
