<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;
use DB;

class CategoryController extends Controller
{
	
	
    function addnew(Request $request) {
	
		        $cat = Category::create([
                'title' => $request['title'], 'parent' => (isset($request['parent']) ? $request['parent'] : 0) , ]);
				
				return $cat;
				
	}
	
	
		function update(Request $request) {
		
		
                 $prod = Category::find($request->id);
				
				 $prod->title = $request->title;
				
				 $prod->save();

                return response()->json(array("message"=>$prod->save()), 200);				 
				
				
				
	}
	
	
	function list(Request $request) {
	
		 
		  $cats = Category::where(['parent'=> $request->parent])->paginate(5, ['*'], 'page', $request->page);
		  
		  return $cats;
		  
	}
	
	
		function deleteCategory(Request $request) {
		
		
		$cat = Category::where(['parent'=> $request->id])->orWhere(['id'=> $request->id]);
		
		
		$prod_cats = DB::table('product_category')->where('category_id', '=', $request->id);
		
		if ($prod_cats) {
			$prod_cats->delete();
		}
		

		
		if ($cat && $cat->delete()) {
			
			    return response()->json(array("message"=>"cat deleted"), 200);
		} else {
			    return response()->json(array("message"=>"cat Not deleted"), 200);
		}
		
	      
		
	}
	

}
