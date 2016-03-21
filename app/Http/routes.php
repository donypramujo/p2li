<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
});

Route::group(['middleware' => 'web','prefix' => 'backend'], function () {
   Route::auth();

   Route::get('/', 'BackendController@index');
    
   Route::group(['prefix' => 'team'], function () {
    	Route::get('/',['as' =>'team.index','middleware'=>'can:team.index' ,'uses' => 'TeamController@index']);
    	Route::get('create',['as' =>'team.create','middleware'=>'can:team.create' ,'uses' => 'TeamController@create']);
    	Route::post('store',['as' =>'team.store','middleware'=>'can:team.store' ,'uses' => 'TeamController@store']);
    	Route::get('{team}',['as' =>'team.show','middleware'=>'can:team.show' ,'uses' => 'TeamController@show']);
    	Route::get('{team}/edit',['as' =>'team.edit','middleware'=>'can:team.edit' ,'uses' => 'TeamController@edit']);
    	Route::put('{team}',['as' =>'team.update','middleware'=>'can:team.update' ,'uses' => 'TeamController@update']);
    	Route::delete('{team}',['as' =>'team.destroy','middleware'=>'can:team.destroy' ,'uses' => 'TeamController@destroy']);
   });
   
   
});
