<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request)
    {
        // Example logic — replace with real registration logic
        return response()->json([
            'message' => 'User registered successfully!',
            'data' => $request->all()
        ], 201);
    }
}
