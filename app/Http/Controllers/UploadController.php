<?php

/**
 * @Author: worldzb
 * @Date:   2018-01-29 23:10:29
 * @Last Modified by:   worldzb
 * @Last Modified time: 2018-01-30 00:39:37
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Qcloud\Cos\Client as CosClient;
use App\Models\imageInfo;

class UploadController extends Controller
{
	private $serverInfo;
	private $bucketInfo;
	public function __construct(){
		$this->serverInfo=[
			'region'=>getenv('COS_REGION'),
			'credentials'=>[
				'appId' => getenv('COS_APPID'),
				'secretId'    => getenv('COS_KEY'),
				'secretKey' => getenv('COS_SECRET')
			],
		];
	}
    public function imgUpload(Request $request){

    	$cosClient=new CosClient($this->serverInfo);
    	$file=$this->decideFileIsValid($request);
    	$this->bucketInfo=[
    		'Bucket'=>'home-1253681650',
    		'Body'=>$file['fileContent'],
    		'Key'=>"/home-1253681650"."/".'-'.$file['date'].'-'.rand(0,10).'.'.$file['fileType'],
    	];
    	try{
    		$result=$cosClient->putObject($this->bucketInfo);
    	}catch(\Exception $e){
    		echo "$e\n";
    	}
    	return $result;
    }

    private function decideFileIsValid(Request $request){
    	$file=[];
    	$date=date('Y-m-d-H-i-s');
    	if($request->file('imgFile')){
    		$file['fileContent']=$request->file('imgFile');
    	}
    	if($file['fileContent']->isValid()){
    		if(in_array(strtolower($file['fileContent']->extension()),['jpeg','jpg','gif','gpeg','png'])){
    			$file['fileType']=strtolower($file['fileContent']->extension());
    		}
    	}
    	$file['date']=$date;
    	return $file;
    }

}

