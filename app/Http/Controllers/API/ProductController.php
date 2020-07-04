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
}
