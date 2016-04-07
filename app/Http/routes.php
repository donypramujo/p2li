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
	Route::get('/' ,'HomeController@index');
	Route::get('/show/{contestant}','HomeController@show');
	Route::get('/live/team/scores','HomeController@showLiveTeamScores');

Route::group(['middleware' => ['web'],'prefix' => 'backend'], function () {
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
   	
   	Route::group(['prefix' => 'config'], function () {
   		Route::get('/',['as' =>'config.index','middleware'=>['permission:config.index'] ,'uses' => 'ConfigController@index']);
   		Route::post('store',['as' =>'config.store','middleware'=>['permission:config.store'] ,'uses' => 'ConfigController@store']);
   	});
   		
   	
   	
   	Route::group(['prefix' => 'category'], function () {
   		Route::get('/',['as' =>'category.index','middleware'=>['permission:category.index'] ,'uses' => 'CategoryController@index']);
   		Route::get('create',['as' =>'category.create','middleware'=>['permission:category.create'] ,'uses' => 'CategoryController@create']);
   		Route::post('store',['as' =>'category.store','middleware'=>['permission:category.store'] ,'uses' => 'CategoryController@store']);
   		Route::get('{category}',['as' =>'category.show','middleware'=>['permission:category.show'] ,'uses' => 'CategoryController@show']);
   		Route::get('{category}/edit',['as' =>'category.edit','middleware'=>['permission:category.edit'] ,'uses' => 'CategoryController@edit']);
   		Route::put('{category}',['as' =>'category.update','middleware'=>['permission:category.update'] ,'uses' => 'CategoryController@update']);
   		Route::delete('{category}',['as' =>'category.destroy','middleware'=>['permission:category.destroy'] ,'uses' => 'CategoryController@destroy']);
   	});
   	
   	Route::group(['prefix' => 'subcategory'], function () {
   		Route::get('/',['as' =>'subcategory.index','middleware'=>['permission:subcategory.index'] ,'uses' => 'SubcategoryController@index']);
   		Route::get('create',['as' =>'subcategory.create','middleware'=>['permission:subcategory.create'] ,'uses' => 'SubcategoryController@create']);
   		Route::post('store',['as' =>'subcategory.store','middleware'=>['permission:subcategory.store'] ,'uses' => 'SubcategoryController@store']);
   		Route::get('{subcategory}',['as' =>'subcategory.show','middleware'=>['permission:subcategory.show'] ,'uses' => 'SubcategoryController@show']);
   		Route::get('{subcategory}/edit',['as' =>'subcategory.edit','middleware'=>['permission:subcategory.edit'] ,'uses' => 'SubcategoryController@edit']);
   		Route::put('{subcategory}',['as' =>'subcategory.update','middleware'=>['permission:subcategory.update'] ,'uses' => 'SubcategoryController@update']);
   		Route::delete('{subcategory}',['as' =>'subcategory.destroy','middleware'=>['permission:subcategory.destroy'] ,'uses' => 'SubcategoryController@destroy']);
   	});
   	
   	
   	Route::group(['prefix' => 'configuration'], function () {
   		Route::get('/',['as' =>'configuration.index','middleware'=>['permission:configuration.index'] ,'uses' => 'ConfigurationController@index']);
   		Route::post('store',['as' =>'configuration.store','middleware'=>['permission:configuration.store'] ,'uses' => 'ConfigurationController@store']);
   	});
   	
   	Route::group(['prefix' => 'contest'], function () {
   		Route::get('/',['as' =>'contest.index','middleware'=>['permission:contest.index'] ,'uses' => 'ContestController@index']);
   		Route::get('create',['as' =>'contest.create','middleware'=>['permission:contest.create'] ,'uses' => 'ContestController@create']);
   		Route::post('store',['as' =>'contest.store','middleware'=>['permission:contest.store'] ,'uses' => 'ContestController@store']);
   		Route::get('{contest}',['as' =>'contest.show','middleware'=>['permission:contest.show'] ,'uses' => 'ContestController@show']);
   		Route::get('{contest}/edit',['as' =>'contest.edit','middleware'=>['permission:contest.edit'] ,'uses' => 'ContestController@edit']);
   		Route::put('{contest}',['as' =>'contest.update','middleware'=>['permission:contest.update'] ,'uses' => 'ContestController@update']);
   		Route::delete('{contest}',['as' =>'contest.destroy','middleware'=>['permission:contest.destroy'] ,'uses' => 'ContestController@destroy']);
   	});
   	
   	Route::group(['prefix' => 'jury'], function () {
   		Route::get('/',['as' =>'jury.index','middleware'=>['permission:jury.index'] ,'uses' => 'JuryController@index']);
   		Route::get('create',['as' =>'jury.create','middleware'=>['permission:jury.create'] ,'uses' => 'JuryController@create']);
   		Route::post('store',['as' =>'jury.store','middleware'=>['permission:jury.store'] ,'uses' => 'JuryController@store']);
   		Route::get('{jury}',['as' =>'jury.show','middleware'=>['permission:jury.show'] ,'uses' => 'JuryController@show']);
   		Route::get('{jury}/edit',['as' =>'jury.edit','middleware'=>['permission:jury.edit'] ,'uses' => 'JuryController@edit']);
   		Route::put('{jury}',['as' =>'jury.update','middleware'=>['permission:jury.update'] ,'uses' => 'JuryController@update']);
   		Route::delete('{jury}',['as' =>'jury.destroy','middleware'=>['permission:jury.destroy'] ,'uses' => 'JuryController@destroy']);
   	});
   
   	Route::group(['prefix' => 'contestant'], function () {
   		Route::get('/',['as' =>'contestant.index','middleware'=>['permission:contestant.index'] ,'uses' => 'ContestantController@index']);
   		Route::get('create',['as' =>'contestant.create','middleware'=>['permission:contestant.create'] ,'uses' => 'ContestantController@create']);
   		Route::post('store',['as' =>'contestant.store','middleware'=>['permission:contestant.store'] ,'uses' => 'ContestantController@store']);
   		Route::get('{contestant}',['as' =>'contestant.show','middleware'=>['permission:contestant.show'] ,'uses' => 'ContestantController@show']);
   		Route::get('{contestant}/edit',['as' =>'contestant.edit','middleware'=>['permission:contestant.edit'] ,'uses' => 'ContestantController@edit']);
   		Route::put('{contestant}',['as' =>'contestant.update','middleware'=>['permission:contestant.update'] ,'uses' => 'ContestantController@update']);
   		Route::delete('{contestant}',['as' =>'contestant.destroy','middleware'=>['permission:contestant.destroy'] ,'uses' => 'ContestantController@destroy']);
   	});
   	
  	Route::group(['prefix' => 'nomination'], function () {
  		Route::get('/',['as' =>'nomination.index','middleware'=>['permission:nomination.index'] ,'uses' => 'NominationController@index']);
   		Route::get('create',['as' =>'nomination.create','middleware'=>['permission:nomination.create'] ,'uses' => 'NominationController@create']);
   		Route::post('store',['as' =>'nomination.store','middleware'=>['permission:nomination.store'] ,'uses' => 'NominationController@store']);
   		Route::get('show',['as' =>'nomination.show','middleware'=>['permission:nomination.show'] ,'uses' => 'NominationController@show']);
   		Route::get('{contestant}/edit',['as' =>'nomination.edit','middleware'=>['permission:nomination.edit'] ,'uses' => 'NominationController@edit']);
   		Route::put('{contestant}',['as' =>'nomination.update','middleware'=>['permission:nomination.update'] ,'uses' => 'NominationController@update']);
   		Route::delete('{contestant}',['as' =>'nomination.destroy','middleware'=>['permission:nomination.destroy'] ,'uses' => 'NominationController@destroy']);
   	});
  	
  	Route::group(['prefix' => 'score'], function () {
  		Route::get('/',['as' =>'score.index','middleware'=>['permission:score.index'] ,'uses' => 'ScoreController@index']);
  		Route::get('create',['as' =>'score.create','middleware'=>['permission:score.create'] ,'uses' => 'ScoreController@create']);
  		Route::post('store',['as' =>'score.store','middleware'=>['permission:score.store'] ,'uses' => 'ScoreController@store']);
  		Route::get('{subcategory}',['as' =>'score.show','middleware'=>['permission:score.show'] ,'uses' => 'ScoreController@show']);
  		Route::get('{score}/edit',['as' =>'score.edit','middleware'=>['permission:score.edit'] ,'uses' => 'ScoreController@edit']);
  		Route::put('{subcategory}',['as' =>'score.update','middleware'=>['permission:score.update'] ,'uses' => 'ScoreController@update']);
  		Route::delete('{score}',['as' =>'score.destroy','middleware'=>['permission:score.destroy'] ,'uses' => 'ScoreController@destroy']);
  	});
  	
  	
  	Route::group(['middleware'=>['role:admin|sa'],'prefix' => 'report'], function () {
  		Route::get('filter/score','ReportController@filterScore');
  		Route::get('print/score','ReportController@printScore');
  		Route::get('filter/score_detail','ReportController@filterScoreDetail');
  		Route::get('print/score_detail','ReportController@printScoreDetail');
  		Route::get('filter/team/score','ReportController@filterTeamScore');
  		Route::get('print/team/score','ReportController@printTeamScore');
  		
  		Route::get('filter/score/by_team','ReportController@filterScoreByTeam');
  		Route::get('print/score/by_team','ReportController@printScoreByTeam');
  		Route::get('filter/score_detail/by_team','ReportController@filterScoreDetailByTeam');
  		Route::get('print/score_detail/by_team','ReportController@printScoreDetailByTeam');
  	});
  	
  	
  	Route::group(['middleware'=>['role:admin|sa'],'prefix' => 'image'], function () {
  		Route::get('/','ImageController@index');
  		Route::get('{contestant}','ImageController@show');
  		Route::post('store','ImageController@store');
  	});
   
   Route::get('/auth/password/change','BackendController@showChangePasswordForm');
   
   Route::post('/auth/password/change','BackendController@changePassword');
   
   
   
   
   
});
