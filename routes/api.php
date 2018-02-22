<?php

use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/',function(){
	return [
		'api_name'=>'worldzb notebook api',
		'version'=>"1.0.0",
		'update_time'=>"2018-2-1",
	];
});

Route::get('/v',function(){
	return [
		'api_name'=>'worldzb notebook api',
		'version'=>"1.0.0",
		'update_time'=>"2018-2-1",
	];
});


Route::group(['prefix' => '/v1','middleware'=>'apiAuth'], function(){
	Route::any('/','Api\BookApiController@help');
	Route::get('/getNewDoc',"Api\BookApiController@getNewDocList");
	Route::get('/getBookList',"Api\BookApiController@getBookList");
	Route::get('/getChapter','Api\BookApiController@getChapter');
	Route::get('/getContent','Api\BookApiController@getContent');
	Route::get('/createBook','Api\BookApiController@createBook');
	Route::get('/createChapter','Api\BookApiController@createChapter');
	Route::get('/createNewDoc','Api\BookApiController@createNewDoc');
	Route::get('/createDoc','Api\BookApiController@createDoc');
});
