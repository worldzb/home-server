<?php

/**
 * @Author: worldzb
 * @Date:   2018-01-16 10:52:55
 * @Last Modified by:   worldzb
 * @Last Modified time: 2018-01-27 15:51:46
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Qcloud\Cos\Client;
use Illuminate\Support\Facades\Redis;
use App\Models\imageInfo;

class IndexController extends Controller
{
    public function index(){
    	$client=new Client([
    		'region'=>getenv('COS_REGION'),
    		'credentials'=>[
    			'appId' => getenv('COS_APPID'),
        		'secretId'    => getenv('COS_KEY'),
        		'secretKey' => getenv('COS_SECRET')
    		],
    		//'timeout'=>60,
    	]);
    	//dd($client->listBuckets());
    	dd($client->listObjects(array('Bucket'=>'lt-1253681650')));
    }

    public function redisTest(){
    	Redis::set('name', 'Taylor');
    	$user = Redis::get('name');
       	dd($user);
    }

    public function modelTest(){
        $image=new imageInfo();
        dd($image);        
    }
}
