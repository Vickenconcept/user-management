<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUserRequest;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(CreateUserRequest $request)
    {
            $user = User::create($request->validated());


            return response()->json([
                'user' => $user,
                'message' => 'User registered Successfully',
                'status' => true,
            ], 201);

    }

    public function login(CreateUserRequest $request)
    {

        if (Auth::attempt($request->only(['email', 'password']))) {

            $user = Auth::user();

            $token = $user->createToken('myToken')->accessToken;
            
            return response()->json([
                'token' => $token,
                'status' => true,
            ]);
        }

        return response()->json([
            'message' => 'Incorrect Credentials',
            'status' => false,
        ]);
    }

    public function profile()
    {
        $user = auth()->user();

        return response()->json([
            'message' => 'Profile found',
            'status' => false,
            'data' => $user,
        ]);
    }

    public function logout(Request $request)
    {

            auth()->user()->token()->revoke();

            return response()->json([
                'message' => 'User Logged Out',
                'status' => true,
            ]);
        

    }
}
