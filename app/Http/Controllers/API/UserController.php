<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\LoggedInUserObject;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /*
     * BUG: Policy disabled due to some actions being denied when they shouldn't be.
    public function __construct()
    {
        $this->authorizeResource(User::class);
    }
    */

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        $users = User::all();
        return response(LoggedInUserObject::collection($users), 200);
    }

    /**
     * @inheritDoc
     */
    public function store(Request $request): Response
    {
        $user = User::create($request->all());

        return response(new UserResource($user), 201);
    }

    /**
     * @inheritDoc
     */
    public function show(User $user): Response
    {
        return response(new UserResource($user), 200);
    }

    /**
     * @inheritDoc
     */
    public function update(Request $request, User $user): Response
    {
        $user->update($request->all());

        return response(new UserResource($user), 200);

    }

    /**
     * @inheritDoc
     */
    public function destroy(User $user): Response
    {
        $user->delete();

        return response([], 200);
    }
}
