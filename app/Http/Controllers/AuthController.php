<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{

    public function getUser(){
        return Auth::user();
    }

    public function register(Request $request){
       $fields = $request->validate([
           'username' => 'required|string|unique:users',
           'first_name'=> 'required|string',
           'last_name'=> 'required|string',
           'password' => 'required|string|confirmed'
       ]);

       $user = User::create([
           'username' => $fields['username'],
           'first_name' => $fields['first_name'],
           'last_name' => $fields['last_name'],
           'password' => bcrypt($fields['password'])
       ]);

       $token = $user->createToken('commentboxtoken')->plainTextToken;

       $response = [
           'user' => $user,
           'token' => $token
       ];


       return response($response, 201);
    }

    public function login(Request $request){
        $fields = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string'
        ]);

        $user = User::where('username', $fields['username'])->first();

        if(!$user || !Hash::check($fields['password'], $user->password)){
            return response([
                'message' => 'Bad credentials'
            ], 401);
        }

        $token = $user->createToken('commentboxtoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }


    public function logout(){
        auth()->user()->tokens()->delete();
        return [
            'message' => 'Logged out'
        ];
    }
}
