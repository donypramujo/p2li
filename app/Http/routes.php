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
    	Route::get('/',['as' =>'team.index','middleware'=>['permission:team.index'] ,'uses' => 'TeamController@index']);
    	Route::get('create',['as' =>'team.create','middleware'=>['permission:team.create'] ,'uses' => 'TeamController@create']);
    	Route::post('store',['as' =>'team.store','middleware'=>['permission:team.store'] ,'uses' => 'TeamController@store']);
    	Route::get('{team}',['as' =>'team.show','middleware'=>['permission:team.show'] ,'uses' => 'TeamController@show']);
    	Route::get('{team}/edit',['as' =>'team.edit','middleware'=>['permission:team.edit'] ,'uses' => 'TeamController@edit']);
    	Route::put('{team}',['as' =>'team.update','middleware'=>['permission:team.update'] ,'uses' => 'TeamController@update']);
    	Route::delete('{team}',['as' =>'team.destroy','middleware'=>['permission:team.destroy'] ,'uses' => 'TeamController@destroy']);
   });
   
   	Route::group(['prefix' => 'user'], function () {
   		Route::get('/',['as' =>'user.index','middleware'=>['permission:user.index'] ,'uses' => 'UserController@index']);
   		Route::get('create',['as' =>'user.create','middleware'=>['permission:user.create'] ,'uses' => 'UserController@create']);
   		Route::post('store',['as' =>'user.store','middleware'=>['permission:user.store'] ,'uses' => 'UserController@store']);
   		Route::get('{user}',['as' =>'user.show','middleware'=>['permission:user.show'] ,'uses' => 'UserController@show']);
   		Route::get('{user}/edit',['as' =>'user.edit','middleware'=>['permission:user.edit'] ,'uses' => 'UserController@edit']);
   		Route::put('{user}',['as' =>'user.update','middleware'=>['permission:user.update'] ,'uses' => 'UserController@update']);
   		Route::delete('{user}',['as' =>'user.destroy','middleware'=>['permission:user.destroy'] ,'uses' => 'UserController@destroy']);
   	});
   
   
   Route::get('/auth/password/change','BackendController@showChangePasswordForm');
   
   Route::post('/auth/password/change','BackendController@changePassword');
   
   
   
   
});
