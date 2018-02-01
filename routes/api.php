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

Route::get('/v',function(){
	return [
		'api_name'=>'worldzb notebook api',
		'version'=>"1.0.0",
		'update_time'=>"2018-2-1",
	];
});

Route::group(['prefix' => '/v1','middleware'=>'apiAuth'], function(){
	Route::any('/','Api\BookApiController@help');
	Route::get('/getBookList',"Api\BookApiController@getBookList");
});