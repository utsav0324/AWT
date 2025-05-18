<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiAuthController extends Controller
{
    public function login()
    {
        return "test login";
    }
    public function logout()
    {

    }
     public function register(Request $request){
       $request->validate();

       $request->validate([
        'name'=> 'required',
        'email'=> 'required|email',
        'password'=>'required',
       ]);
       User::create($request->all());

       return response()->json([
        'message'=>'User created successfully',
      ]);

}
}