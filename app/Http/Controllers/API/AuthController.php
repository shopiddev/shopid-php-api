<?php
namespace App\Http\Controllers\API;

use App\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function register(Request $request)
    {

        if (preg_match('!@!is', $request->username))
        {

            $validator = Validator::make($request->all() , [

            'username' => ['unique:users,email'],

            ]);

            if ($validator->fails())
            {

                return response(array(
                    "fail"
                ));

            }
            else
            {

                $user = User::create([

                'email' => $request['username'], 'password' => Hash::make($request['password']) , ]);

            }

        }
        else
        {

            $validator = Validator::make($request->all() , [

            'username' => ['unique:users,phone'],

            ]);

            if ($validator->fails())
            {

                return response(array(
                    "message"=>"signup-failed"
                ),401);

            }
            else
            {

                $user = User::create([

                'phone' => $request['username'], 'password' => Hash::make($request['password']) , ]);

            }

        }

        if (isset($user))
        {
            $accessToken = $user->createToken('authToken')->accessToken;
            return response(['user' => $user, 'token' => $accessToken,'message'=>"signedup"]);
        }

    }

    public function login(Request $request)
    {
		
		$logedin = false;

        if (isset($request->username) && isset($request->password))
        {

            if (preg_match('!@!is', $request->username))
            {

                $logedin = Auth::attempt(['email' => $request->username, 'password' => $request->password]);
            }
            else
            {
                $logedin = Auth::attempt(['phone' => $request->username, 'password' => $request->password]);
            }

        }

        if (!$logedin)
        {
            return response()->json(['message' => 'wrong-user-pass'], 401);
        }
        else
        {
            $user = $request->user();
            $tokenResult = $user->createToken('Personal Access Token');
            $token = $tokenResult->token;
            $token->save();

            return response()
                ->json([
				'token' => $tokenResult->accessToken,
				'message'=>"loggedin"
				]);
        }

    }
}

