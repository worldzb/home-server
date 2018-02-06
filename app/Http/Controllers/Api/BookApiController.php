<?php

/**
 * @Author: worldzb
 * @Date:   2018-02-01 13:03:29
 * @Last Modified by:   worldzb
 * @Last Modified time: 2018-02-06 16:55:27
 */
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\NewDoc;
use App\Models\BookList;
/**
* 
*/
class BookApiController extends Controller
{

	protected $baseInfo=[];

	/**
	 * 初始化基础信息
	 * @param Request $request [description]
	 */
	public function __construct(Request $request){
		$arrTemp=[];
		$arrTemp['url']=$request->url();
		$arrTemp['ajax']=$request->ajax();
		$this->baseInfo=$arrTemp;
	}
	/**
	 * API help 方法
	 * @return [type] [api调用帮助信息]
	 */
	public function help(){
		$arr=[
			'apiName'=>'worldzb noteBook api',
			'commands'=>[
				'help'=>'api帮助',
				'官网地址'=>"http://www.worldzb.cn",
				'getBookList'=>'获取图书列表',
			]
		];
		return $this->dateReturn($arr);
	}

	/**
	 * api 数组组装方法
	 * @param  Array  $arr [需要组装的数组]
	 * @return Array       [合并基础信息之后的数据]
	 */
	protected function dateReturn(Array $arr){
		return array_merge($this->baseInfo,$arr);
	}


	/**
	 * 获取图书列表
	 * @param  Request $request [请求]
	 * @return [Array]          [图书列表]
	 */
	public function getNewDocList(Request $request){
		$newDoc=new NewDoc();
		$arr= [
			'status'=>'200',
			'msg'=>"ok",
			'body'=>$newDoc->all(),
		];
		return $this->dateReturn($arr);
	}


	public function getBookList(Request $request){

		$bl=new BookList();
		$booklist=[
			'status'=>200,
			'msg'=>'ok',
			'body'=>$bl->all(),
		];

		return $this->dateReturn($booklist);
	}






	
	/**
	 * 测试
	 */
	public function test(){

	}
}




