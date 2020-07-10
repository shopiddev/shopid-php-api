<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

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
		return Product::find($request->id);
	}
	
	
	function deleteProduct(Request $request) {
		$prod = Product::find($request->id);
		
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

                return response()->json(array("message"=>$prod->save()), 200);		
				 } else {
					 
				$prod = Product::create([
                'title' => $request['title'], 'caption' => $request['caption'] , ]);
				
				return $prod;
					 
				 }
			
	}
	
	
	
	function updateProduct(Request $request) {
		
		
                 $prod = Product::find($request->id);
				
				 $prod->title = $request->title;
				 $prod->caption = $request->caption;
				 $prod->save();

                return response()->json(array("message"=>$prod->save()), 200);				 
				
				
				
	}
	
	
	
	
}
