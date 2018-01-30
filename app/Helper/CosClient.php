<?php

/**
 * @Author: worldzb
 * @Date:   2018-01-30 19:34:15
 * @Last Modified by:   worldzb
 * @Last Modified time: 2018-01-31 00:29:28
 */
namespace App\Helper;

use Qcloud\Cos\Client;
use App\Models\ImageInfo;
use Illuminate\Http\Request;

/**
* 
*/
class CosClient
{
	private $serverInfo;
	private $bucketInfo;
	private $request;
	private $folder;

	const bucket="home-1253681650";

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
	 * 图片上传完成后写入数据库
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
		$Client=new Client($this->serverInfo);
		$result="";
		try{
			$result=$Client->putObject($this->bucketInfo);
			$this->writeToDB(array(
				'imgName'=>$file['content']->getClientOriginalName(),
				'url'=>$result['ObjectURL'],
				'cosUrl'=>'aaa',
				'type'=>$file['fileType']
			));
		}catch(\Exception $e){
			echo "$e\n";
		}
		return $result;
	}

}





