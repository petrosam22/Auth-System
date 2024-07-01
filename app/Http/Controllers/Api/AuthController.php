<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

USE App\Models\User;
class AuthController extends Controller
{
    public function register(Request $request){

        $user  = User::create([
            'name'=> $request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),

            
        ]);

        $token = $user->createToken('user-api')->accessToken;


        return response()->json([
            'user'=>$user,
            'token'=>$token,
        ]);
    }


    public function login(Request $request){

        $user = User::where('name',$request->name)->first();


        if($user){
            if(Hash::check($request->password,$user->password)){
                $token = $user->createToken('Member-api')->accessToken;
                 return response()->json(['token' => $token],200);
            }else{
                return response()->json(['message' => 'userName or Password is incorrect'], 401);

            }
        }else{
            return response()->json(['message' => 'userName Not Found'], 401);

        }
    }


    public function logout(){
            auth()->logout();


    }
}
