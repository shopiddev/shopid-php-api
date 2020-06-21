<?php

namespace App\Http\Controllers\API;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Contracts\Validation\Validator;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
	public function register(Request $request) {


          if (preg_match('!@!is',$request->username)) {

               $user=  User::create([
                    'name' => "new",
                    'email' => $request['username'],
                    'password' => Hash::make($request['password']),
                    ]);


          } else {


              $user=  User::create([
                    'name' => "new",
                    'mobile' => $request['username'],
                    'password' => Hash::make($request['password']),
                    ]);
               
               }

     
               $accessToken = $user->createToken('authToken')->accessToken;

               return response([ 'user' => $user, 'access_token' => $accessToken]);

              



     }
}
