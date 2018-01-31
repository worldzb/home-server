<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', "IndexController@index");
Route::get('/r','IndexController@redisTest');
Route::get('/m','IndexController@modelTest');

Route::any('/imgUpload','UploadController@imgUpload');

Route::group([],function(){

});

Route::group(['prefix' => 'api/v1'], function(){
	Route::get('/', "IndexController@index");
	//Route::resource('lessons','LessonsController');
});



