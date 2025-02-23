<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request) {
       $request->validate([
         'name' => 'required|string|max:100',
         'email'=> 'required|email|unique:users',
         'password' => 'required|string|min:6|confirmed',
       ]);

       $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->string('password')),
       ]);

       if(!$user){
         return request()->json([
            'message' => 'Failed to register the user',
         ], Response::HTTP_BAD_REQUEST);
       }

       return request()->json([
        'message' =>'User registered successfully!',
        'token' => $user->createToken($user['name'])->plainTextToken,
       ], Response:: HTTP_CREATED);
    }


    public function login(Request $request){

       $credentials = $request->validate([

            'email'=> 'required|email',
            'password' => 'required|string|min:6',

          ]);
          if (!Auth::attempt($credentials)) {
            return response()->json([
                    'message' =>'Unauthorized',
                ], Response::HTTP_UNAUTHORIZED);
               }

               $user = $request->user();

               return response()->json([
                'message' => 'Logged in successfully!',
                 'token' => $user->createToken($user['name'])->plainTextToken
               ],Response::HTTP_OK);

    }

    public function logout(Request $request){

       $request->user()->tokens()->delete();

       return response()->json([
        'message' => 'You are now logged out',
       ],Response::HTTP_OK);
    }
}
