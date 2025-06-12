<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\UserCreated;
use App\Models\Otp;
use App\Models\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Mail;

class AuthController extends Controller
{


    



    // This function is for registering a new user/

    public function register(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ]);

        
        
        $existingUser = User::where('email', $request->email)->first();

        if ($existingUser) {
            throw ValidationException::withMessages([
                'email' => 'Email already in use'
            ]);
        }

        $value = rand(1000, 9999);
       

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        $otp = Otp::create([
            'user_id' => $user->id,
            'value' => $value,
        ]);

        Mail::to($user->email)->send(new UserCreated($otp));

        return response()->json([
            'message' => 'User created successfully',
            'user' => $user,
        ]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials'
            ]);
        }
        if (!Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => 'Invalid credentials'
            ]);
        }

        $token = $user->createToken('api-token')->plainTextToken;
        return response()->json([
            'token' => $token,
            'user' => [
                'name'=>$user->name,
                'email'=>$user->email,
            ]
        ]);
    }
    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }


    public function getProfile(Request $request)
    {
        return "Error";
    }

    public function getUserDetails(){

        return response()->json([
            'user' => auth()->user()
        ]);
    }

}