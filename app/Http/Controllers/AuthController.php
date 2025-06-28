<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $user = User::create([
            "first_name" => $request->first_name,
            "last_name" => $request->last_name,
            "age" => $request->age,
            "username" => $request->username,
            "password" => bcrypt($request->password),
        ]);

        $token = $user->createToken("api-token")->plainTextToken;

        return response()->json([
            "message" => __("messages.register_success"),
            "user" => $user,
            "token" => $token
        ], 201);
    }


    public function login(LoginRequest $request)
    {
        $user = User::where("username", $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                "message" => __("messages.invalid_credentials")
            ], 401);
        }

        $token  = $user->createToken("api-token")->plainTextToken;

        return response()->json([
            "message" => __("messages.login_success"),
            "user" => $user,
            "token" => $token
        ], 200);
    }


    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            "message" => __("messages.logout_success")
        ], 200);
    }
}
