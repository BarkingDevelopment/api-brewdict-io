<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

/***
 * Implements OAuth PAssword Grant. While this goes against OAuth2 guidelines, this is the simplest version of token
 * authentication I can implement and still provides a level of security.
 */
class ApiAuthController extends Controller
{
    const TOKEN_NAME = "Laravel Password Grant Client";

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username" => "required|string|max:63|unique:users",
            "email" => "required|email|string|max:255|unique:users",
            "password" => ["required", "string", Password::min(7)->mixedCase()->numbers()->symbols(), "confirmed"],
        ]);

        if ($validator->fails())
        {
            return response(["message" => "Registration failed.", "errors" => $validator->errors()->all()], 422);
        }

        $request["password"] = Hash::make($request->password);
        $request["remember_token"] = Str::random(10);

        $user = User::create($request->toArray());

        $accessToken = $user->createToken(self::TOKEN_NAME)->accessToken;

        return response(["message" => "Registration successful.", "user" => $user, "access_token" => $accessToken], 201);
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username" => "required_without:email|string|max:63",
            "email" => "required_without:username|email|max:255",
            "password" => "required|string|min:7"
        ]);

        if ($validator->safe()->all()) {
            $user = User::where("username", $request->username)->orWhere("email", $request->email)->first();
            if ($user) {
                if (Hash::check($request->password, $user->password)) {
                    $accessToken = $user->createToken(self::TOKEN_NAME)->accessToken;
                    return response(["message" => "Login successful.", "access_token" => $accessToken], 200);

                } else { $errorResponse = ["message" => "Login failed, please check your details."]; }

            } else { $errorResponse = ["message" => "Login failed, please check your details."]; }

        } else { $errorResponse = ["message" => "Login failed.", "errors" => $validator->errors()->all()]; }

        return response($errorResponse, 422);
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();

        return response(["message" => "Successfully logged out."], 200);
    }
}
