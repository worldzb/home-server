<?php

/**
 * @Author: worldzb
 * @Date:   2018-02-01 13:03:29
 * @Last Modified by:   worldzb
 * @Last Modified time: 2018-02-21 23:22:57
 */
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

use App\Models\NewDoc;
use App\Models\BookList;
use App\Models\DocContent;
use App\Models\Chapter;

/**
* 
*/
class BookApiController extends Controller
{

	protected $baseInfo=[];

	/**
	 * 初始化基础信息
	 * @param Request $request []
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
	 * 获取最新文档列表
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

	/**
	 * 获取图书列表
	 * @param  Request $request []
	 * @return [type]           []
	 */
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
	 * 获取图书章节信息
	 * @param  Request $request []
	 * @return [type]           []
	 */
	public function getChapter(Request $request){
		$chapter=new Chapter();
		$red=$chapter->where('book_id','=',Input::get('id'))->get();
		$chapterList=[
			'status'=>200,
			'msg'=>'ok',
			'body'=>$red,
		];
		return $this->dateReturn($chapterList);
	}

	/**
	 * 获取章节内容
	 * @param  Request $request []
	 * @return [type]           []
	 */
	public function getContent(Request $request){
		$content=new DocContent();
		$red=$content->where('id','=',Input::get('id'))->get();
		$redContent=[
			'status'=>200,
			'msg'=>'ok',
			'body'=>$red,
		];
		return $this->dateReturn($redContent);
	}



	/**
	 * 添加图书
	 * @param  Request $request []
	 * @return [type]           []
	 */
	public function createBook(Request $request){
		$bookList=new BookList();
		$bookList->bookName=Input::get('bookName');//
		$bookList->author=Input::get('author');
		$bookList->created_at=date("Y-m-d H:i:s");
		$bookList->updated_at=date("Y-m-d H:i:s");
		$red=$bookList->save();
		if($red){
			$arrRed=[
				'status'=>201,
				'msg'=>'创建成功',
				'body'=>$bookList,
			];
			return $this->dateReturn($arrRed);
		}
	}

	/**
	 * 创建章节
	 * @param  Request $request []
	 * @return [type]           []
	 */
	public function createChapter(Request $request){
		$chapter=new Chapter();
		$chapter->doc_title="aaa";
		$chapter->add_man="worldzb";
		$chapter->book_id=3;
		$chapter->cotent_id=5;
		$chapter->created_at=date("Y-m-d H:i:s");
		$chapter->updated_at=date("Y-m-d H:i:s");
		$red=$chapter->save();
		if($red){
			$arrRed=[
				'status'=>201,
				'msg'=>'创建成功',
				'body'=>$chapter,
			];
			return $this->dateReturn($arrRed);
		}
	}

	/**
	 * [创建最近文档]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function createNewDoc(Request $request){
		$newDoc=new NewDoc();
		$newDoc->doc_title="aaa";
		$newDoc->add_man="worldzb";
		$newDoc->cotent_id='5';
		$newDoc->created_at=date("Y-m-d H:i:s");
		$newDoc->updated_at=date("Y-m-d H:i:s");
		$red=$newDoc->save();
		if($red){
			$arrRed=[
				'status'=>201,
				'msg'=>'创建成功',
				'body'=>$newDoc,
			];
			return $this->dateReturn($arrRed);
		}
	}

	/**
	 * 创建文档内容
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function createDoc(Request $request){
		$content=new DocContent();
		$content->title="";
		$content->content="";
		$content->bookList_id=2;
		$content->version=1;
		$content->created_at=date("Y-m-d H:i:s");
		$content->updated_at=date("Y-m-d H:i:s");
		$red=$content->save();

		if($red){
			$arrRed=[
				'status'=>201,
				'msg'=>'创建成功',
				'body'=>$content,
			];
			return $this->dateReturn($arrRed);
		}
	}

	/**
	 * 创建文档并且填入章节信息
	 * @return [type] [description]
	 */
	public function createChapterAndDoc(){
		$contnet=new DocContent();
		$content=new DocContent();
		$content->title="";
		$content->content="";
		$content->bookList_id=2;
		$content->version=1;
		$red=$content->save();
		//判断章节是否有归属的图书
		if(Input::get('bookList_id')&&$red){
			//有
			$chapter=new Chapter();
			$chapter->doc_title="aaa";
			$chapter->add_man="worldzb";
			$chapter->book_id=3;
			$chapter->cotent_id=5;
			$red=$newDoc->save();
		}else{
			//没有
			$newDoc=new NewDoc();
			$newDoc->doc_title="aaa";
			$newDoc->add_man="worldzb";
			$newDoc->cotent_id='5';
			$red=$newDoc->save();
		}

	}











	
	/**
	 * 测试
	 */
	public function test(){
		
	}
}




