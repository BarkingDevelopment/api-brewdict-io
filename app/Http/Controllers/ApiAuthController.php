<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;

/***
 * Implements OAuth Password Grant. While this goes against OAuth2 guidelines, this is the simplest version of token
 * authentication I can implement and still provides a level of security.
 */
class ApiAuthController extends Controller
{
    const TOKEN_NAME = "Brewdict.io Password Grant Client";

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username" => "required|alpha_dash|max:31|unique:users",
            "email" => "required|email|max:63|unique:users",
            "password" => ["required", "string", Password::min(7)->mixedCase()->numbers()->symbols(), "confirmed"],
        ]);

        if ($validator->fails())
        {
            return response(["errors" => $validator->errors()->all()], 422);
        }

        $request["password"] = Hash::make($request->password);
        $request["remember_token"] = Str::random(10);

        $user = User::create($request->toArray());

        $token = $user->createToken(self::TOKEN_NAME);

        // TODO Enforce email verification. Don't return access token on registration.
        return response([
            "user" => new UserResource($user),
            "token" => $token->accessToken
        ], 201)->header("Cache-Control", "no-store");
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "username" => "required_without:email|string|max:31",
            "email" => "required_without:username|email|max:63",
            "password" => "required|string|min:7"
        ]);

        if ($validator->safe()->all()) {
            $user = User::where("username", $request->username)->orWhere("email", $request->email)->first();

            if ($user) {
                // FIXME: Identified sending plain text password over the internet. Why did I think this was a good idea? Compare the password sent with the hashed password stored in the db. Get the client to hash the password before sending.
                if (Hash::check($request->password, $user->password)) {
                    $token = $user->createToken(self::TOKEN_NAME);

                    return response([
                        "user" => new UserResource($user),
                        "token" => $token->accessToken
                    ], 200)->header("Cache-Control", "no-store");

                } else { $errorResponse = ["errors" => "Login failed, please check your details."]; }

            } else { $errorResponse = ["errors" => "Login failed, please check your details."]; }

        } else { $errorResponse = ["errors" => $validator->errors()->all()]; }

        return response($errorResponse, 422);
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();

        return response([], 204);
    }
}
