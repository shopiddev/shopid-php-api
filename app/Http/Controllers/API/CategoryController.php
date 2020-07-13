<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
	
	
    function addnew(Request $request) {
	
		        $cat = Category::create([
                'title' => $request['title'], 'parent' => (isset($request['parent']) ? $request['parent'] : 0) , ]);
				
				return $cat;
				
	}
	
	
	function list(Request $request) {
	
		 
		  $cats = Category::where(['parent'=> $request->parent])->paginate(5, ['*'], 'page', $request->page);
		  
		  return $cats;
		  
	}
	

}
