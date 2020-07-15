<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', 'API\AuthController@register');
Route::post('/login', 'API\AuthController@login');

Route::post('/addnew', 'API\ProductController@addnew');


Route::get('/category/{id}/delete', 'API\CategoryController@deleteCategory');
Route::post('/category/add', 'API\CategoryController@addnew');
Route::post('/category/{id}/update', 'API\CategoryController@update');
Route::get('/category/{parent}', 'API\CategoryController@list');


Route::get('/product/{id}/delete', 'API\ProductController@deleteProduct');

Route::post('/product/{id}', 'API\ProductController@setProduct');

Route::get('/product/{id}', 'API\ProductController@singleProduct');


Route::get('/list', 'API\ProductController@listOfProduct');



Route::middleware('apiauth')->get('/user', function (Request $request) {
	//sleep(6);
    return $request->user();
	//return array("ok");
});
