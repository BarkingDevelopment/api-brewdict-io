<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        $users = User::all();
        return response([ "users" => UserResource::collection($users), "message" => "Retrieved successfully."], 200);
    }

    /**
     * @inheritDoc
     */
    public function store(Request $request): Response
    {
        $user = User::create($request->all());

        return response(["user" => new UserResource($user), "message" => "$user->email created successfully"], 201);
    }

    /**
     * @inheritDoc
     */
    public function show(User $user): Response
    {
        return response(["user" => new UserResource($user), "message" => "$user->email retrieved successfully"], 200);
    }

    /**
     * @inheritDoc
     */
    public function update(Request $request, User $user): Response
    {
        $user->update($request->all());

        return response(["user" => new UserResource($user), "message" => "$user->email updated successfully."], 200);

    }

    /**
     * @inheritDoc
     */
    public function destroy(User $user): Response
    {
        $user->delete();

        return response(["message" => "$user->email deleted"], 200);
    }
}
