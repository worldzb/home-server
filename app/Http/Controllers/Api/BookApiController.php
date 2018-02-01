<?php

/**
 * @Author: worldzb
 * @Date:   2018-02-01 13:03:29
 * @Last Modified by:   worldzb
 * @Last Modified time: 2018-02-01 13:57:35
 */
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\NewDoc;

/**
* 
*/
class BookApiController extends Controller
{

	protected $baseInfo=[];

	public function __construct(Request $request){
		$arrTemp=[];
		$arrTemp['url']=$request->url();
		$arrTemp['ajax']=$request->ajax();
		$this->baseInfo=$arrTemp;
	}
	protected function dateReturn(Array $arr){
		return array_merge($this->baseInfo,$arr);
	}
	public function getBookList(Request $request){
		$newDoc=new NewDoc();
		$arr= [
			'status'=>'200',
			'msg'=>"ok",
			'body'=>$newDoc->all(),
		];
		return $this->dateReturn($arr);
	}

	public function help(){
		$arr=[
			'apiName'=>'worldzb noteBook api',
			'commands'=>[
				'help'=>'api帮助',
				'getBookList'=>'获取图书列表',
			]
		];
		return $this->dateReturn($arr);
	}

}




