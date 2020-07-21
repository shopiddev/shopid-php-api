<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;
use DB;

class ProductController extends Controller
{
    function addnew(Request $request) {
		
		
		
		        $prod = Product::create([
                'title' => $request['title'], 'caption' => $request['caption'] , ]);
				
				return $prod;
				
	}
	
	function listOfProduct() {
		return Product::latest()->take(5)->get();
	}
	
	
	function singleProduct(Request $request) {
		
		$prod = Product::find($request->id);
		
		$prod->cats = DB::table('product_category',"category_id")->where('product_id', '=', $request->id)->get();
		
		return $prod;
	}
	
	
	function deleteProduct(Request $request) {
		$prod = Product::find($request->id);
		

		
		$cats = DB::table('product_category')->where('product_id', '=', $request->id);
		
		if ($cats) {
			$cats->delete();
		}
		
		if ($prod && $prod->delete()) {
			
			    return response()->json(array("message"=>"prod deleted"), 200);
		} else {
			    return response()->json(array("message"=>"NOT deleted"), 200);
		}
		
		        
		
	}
	
	function setProduct(Request $request) {
		
		         if ($request->id > 0) {
				$prod = Product::find($request->id);
				
				 $prod->title = $request->title;
				 $prod->caption = $request->caption;
				 $prod->save();

                $ret = response()->json(array("message"=>$prod->save()), 200);		
				 } else {
					 
				$prod = Product::create([
                'title' => $request['title'], 'caption' => $request['caption'] , ]);
			
			
				$ret = $prod;
					 
				 }
				 
				 
				if (isset($request['cats'])) {
					
					
					
					
					

					
					foreach ($request['cats'] as $cat) {
						
						
						$request['cats'] = array_merge($request['cats'],Category::getParents($cat));
						
						
					}
					
					$request['cats'] = array_unique($request['cats']);

					
									foreach ($request['cats'] as $cat) {
										
										
										$product_category[] = 	['product_id' => $prod->id, 'category_id' => $cat];
									}
									
									
									DB::table('product_category')->where('product_id', '=', $prod->id)->delete();
				
									DB::table('product_category')->insert($product_category);
				}
				 
				 
				 return $ret;
			
	}
	
	
	
	function updateProduct(Request $request) {
		
		
                 $prod = Product::find($request->id);
				
				 $prod->title = $request->title;
				 $prod->caption = $request->caption;
				 $prod->save();

                return response()->json(array("message"=>$prod->save()), 200);				 
				
				
				
	}
	
	
	
	
}
