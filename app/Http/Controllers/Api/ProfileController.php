<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use App\Http\Requests\UpdateUserRequest;

class ProfileController extends Controller
{
    public function getUser(){

        $profile = Auth::user();


        return response()->json([
            
            'data'=>$profile,
         ]);

    }
    public function updateUser(UpdateUserRequest $request){

        $profile = User::where('id',Auth::user()->id)->first();

        $profile->update([
            'name'=> $request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),

        ]);
        


        return response()->json([
            
            'data'=>$profile,
            'message'=>'Profile Update It Successfully',
        ]);

    }
}
