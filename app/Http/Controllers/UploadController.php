<?php

/**
 * @Author: worldzb
 * @Date:   2018-01-29 23:10:29
 * @Last Modified by:   worldzb
 * @Last Modified time: 2018-01-30 20:07:09
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\CosClient;

class UploadController extends Controller
{
	
    public function imgUpload(Request $request){
    	$cosClient=new CosClient($request,'test');
    	$result = $cosClient->upload();
    	return $result['ObjectURL'];
    }
}

