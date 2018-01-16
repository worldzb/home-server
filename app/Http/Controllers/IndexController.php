<?php

/**
 * @Author: worldzb
 * @Date:   2018-01-16 10:52:55
 * @Last Modified by:   worldzb
 * @Last Modified time: 2018-01-16 11:32:20
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
    	return array('msg'=>Request::class);
    }
}
