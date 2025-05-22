<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class Authcontroller extends Controller
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