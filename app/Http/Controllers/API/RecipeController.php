<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Objects\RecipeResourceObject;
use App\Http\Resources\RecipeCollection;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class RecipeController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Recipe::class);
    }

    public function index(): Response
    {
        $recipes = Recipe::all();
        return response(new RecipeCollection($recipes), 200);
    }

    public function store(Request $request, User $user): Response
    {
        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:63",
            "description" => "required|string|max:255",
            "inspiration_id" => "exists:recipes,id",
            "style_id" => "exists:styles,id",
        ]);

        if ($validator->fails())
        {
            return response(["errors" => $validator->errors()->all()], 422);
        }

        $recipe = Recipe::create([
            "name" => $request->name,
            "description" => $request->description,
            "inspiration_id" => $request->inspiration_id,
            "style_id" => $request->style_id,
            "owner_id" => $user->id,
            ]
        );

        return response(new RecipeResourceObject($recipe), 201);
    }

    public function show(Recipe $recipe): Response
    {
        return response(new RecipeResource($recipe), 200);
    }

    public function update(Request $request, Recipe $recipe): Response
    {
        if ($recipe->isEmpty()) return response(["errors" => ["The selected recipe id is invalid."]], 404);

        $validator = Validator::make($request->all(), [
            "name" => "string|max:63",
            "description" => "string|max:255",
            "inspiration_id" => "exists:recipes,id",
            "style_id" => "exists:styles,id",
        ]);

        if ($validator->fails()) return response(["errors" => $validator->errors()->all()], 422);

        return response(new RecipeResourceObject($recipe), 200);
    }

    public function destroy(Recipe $recipe): Response
    {
        // BUG Resolve recursive relationships. TLDR; Once a recipe has a recipe that takes inspiration from it, how do we resolve the "parent" recipe being deleted?
        $recipe->delete();

        return response([], 200);
    }
}
