<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(Request $request)
    {
       $fiels = $request->validate([
           'name' => 'required|string',
           'email' => 'required|string|unique:users,email',
           'password' => 'required|string|confirmed'
       ]);

       $user = User::create([
           'name' => $fiels['name'],
           'email' => $fiels['email'],
           'password' => bcrypt($fiels['password'])
       ]);

       $token = $user->createToken('myapptoken')->plainTextToken;

       $response = [
           'user' => $user,
           'token' => $token
       ];

       return response($response, 201);
    }


    public function login() {
        $fiels = request()->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        // Check email
        $user = User::where('email', $fiels['email'])->first();

        // Check password
        if(!$user || !Hash::check($fiels['password'], $user->password)) {
            return response([
                'message' => 'Bad creds'
            ], 401);
        }

        // Create token
        $token = $user->createToken('myapptoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);

    }


    public function logout() {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Logged out'
        ];
    }
}
