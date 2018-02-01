<?php

/**
 * @Author: worldzb
 * @Date:   2018-01-30 19:34:15
 * @Last Modified by:   worldzb
 * @Last Modified time: 2018-02-01 08:43:24
 */

namespace App\Helper;

use Qcloud\Cos\Client;
use App\Models\ImageInfo;
use Illuminate\Http\Request;

/**
* cos 操作类
*/
class CosClient
{
	private $serverInfo;	// cos 服务器 信息
	private $bucketInfo;	// bucket 信息
	private $request;		//request 请求
	private $folder; 		//cos 文件夹目录
	private $instance; 		//cos client 实例

	const bucket="home-1253681650";	//包名称

	/**
	 * init info
	 * @param Request $r        request请求对象
	 * @param string  $folder   要上传到的文件夹
	 */
	function __construct(Request $r,$folder='')
	{
		$this->request=$r;
		$this->folder=$folder;
		$this->serverInfo=[
			'region'=>getenv('COS_REGION'),
			'credentials'=>[
				'appId' 	=> 	getenv('COS_APPID'),
				'secretId'	=> 	getenv('COS_KEY'),
				'secretKey' => 	getenv('COS_SECRET')
			],
		];
		$this->instance=new Client($this->serverInfo);
	}

	/**
	 * 获取上传文件信息
	 * @return [type] [description]
	 */
	private function getFileInfo(){
		$file=[];
    	$file['date']=date('Y-m-d-H-i-s');
    	
    	if($this->request->file('imgFile')){
    		$file['content']=$this->request->file('imgFile');
    		if(in_array(strtolower($file['content']->extension()),['jpeg','jpg','gif','gpeg','png','bmp','gif'])){
    			$file['fileType']=strtolower($file['content']->extension());
    		}else{
    			return '文件格式不匹配';
    		}
    	}else{
    		return '文件不存在';
    	}
    	$this->bucketInfo=[
    		'Bucket'=>self::bucket,
    		'Body'=>fopen($file['content'], 'rb'),
    		'Key'=>"/".$this->folder."/".$file['date'].'-'.rand(0,10).'.'.$file['fileType'],
    	];
    	return $file;
	}

	/**
	 * 图片上传完成后写入数据库操作
	 * @return [type] [description]
	 */
	private function writeToDB(Array $arrFileInfo){
		$imageInfo=new imageInfo();
		$imageInfo->imgName=$arrFileInfo['imgName'];
		$imageInfo->url=$arrFileInfo['url'];
		$imageInfo->cosUrl=$arrFileInfo['cosUrl'];
		$imageInfo->type=$arrFileInfo['type'];
		$imageInfo->addMan='aaa';
		$imageInfo->classify='bbb';
		$imageInfo->remark='fadfdsfadsf';
		$imageInfo->liked=0;
		$imageInfo->comment=0;
		$imageInfo->save();
	}

	/**
	 * 图片上传
	 * @return [type] [description]
	 */
	public function upload(){
		$file=$this->getFileInfo();
		$Client=$this->instance;
		$result="";
		try{
			$result=$Client->putObject($this->bucketInfo);
			$this->writeToDB(array(
				'imgName'=>$file['content']->getClientOriginalName(),
				'url'=>$result['ObjectURL'],
				'cosUrl'=>'aaa',
				'type'=>$file['fileType'],
			));
		}catch(\Exception $e){
			echo "$e\n";
		}
		return $result;
	}
}





