<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NewDoc;

class NoteBookController extends Controller
{
    //
    public function getNewDocList(){
    	$newDoc=new NewDoc();
    	return $newDoc->all();
    }
}
