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
	
	
	function DeleteProduct(Request $request) {
		$prod = Product::find($request->id);
		
		if ($prod && $prod->delete()) {
			return (array("message"=>"prod deleted"));
		} else {
			return (array("message"=>"NOT deleted!"));
		}
		
	}
	
	
}
