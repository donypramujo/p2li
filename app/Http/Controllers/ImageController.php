<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Intervention\Image\Facades\Image;
use App\Repositories\ContestRepository;
use App\Contestant;
use Illuminate\Support\Facades\Storage;

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
        
//     	$contestants = 	Contestant::has('image')->where('small_image_id',NULL)->get();
    	
//     	foreach($contestants as $contestant  ){
    	
//     	$image =  \App\File::find($contestant->image->id);
    	
    	
    	
//     	$small_image =new \App\File();
    	
//     	$small_image->path = 'public/images/contestant/small/';
//     	$small_image->file_name = $image->file_name;
//     	$small_image->mime_type = $image->mime_type;
    	
//     	$small_image->save();
    	
    	
//     	$contestant->small_image()->associate($small_image);
//     	$contestant->save();
//     	}
    	
    	
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
    	
    	if(!is_null($contestant->image)){
    		$image_file_id = $contestant->image->id;
    		
    		$contestant->image()->dissociate();
    		$contestant->save();
    		
    		$image_file = \App\File::find($image_file_id);

    		unlink($image_file->full_path);
    		
    		$image_file->delete();
    	}
    	
    	if(!is_null($contestant->small_image)){
    		$image_file_id = $contestant->small_image->id;
    	
    		$contestant->small_image()->dissociate();
    		$contestant->save();
    	
    		$image_file = \App\File::find($image_file_id);
    		
    		unlink($image_file->full_path);
    		
    		$image_file->delete();
    	}
    	
    	
    	$file_name = $request->file('image')->getClientOriginalName();
    	
    	$tmp = explode('.', $file_name);
    	$ext = end($tmp);
    	
    	
    	$pathname = $request->file('image')->getPathname();
    	
    	$image = Image::make($pathname);
    
    	
    	$image->save(config('image.contestant_path').$id.'.'.$ext);
    	$image->resize(160,120)->save(config('image.contestant_small_path').$id.'.'.$ext);
    	
    	
    	$image_file = new \App\File();
    	$image_file->path = config('image.contestant_path');
    	$image_file->mime_type = $request->file('image')->getMimeType();
    	$image_file->file_name = $id.'.'.$ext;
    	
    	$image_file->save();
    	
    	$small_image_file = new \App\File();
    	$small_image_file->path = config('image.contestant_small_path');
    	$small_image_file->mime_type = $image_file->mime_type;
    	$small_image_file->file_name = $image_file->file_name;
    	
    	$small_image_file->save();
    	
    	$contestant->image()->associate($image_file);
    	$contestant->small_image()->associate($small_image_file);
    	
    	
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
