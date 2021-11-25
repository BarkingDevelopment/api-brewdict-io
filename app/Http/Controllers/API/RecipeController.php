<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RecipeController extends Controller
{
    /**
     * @inheritDoc
     *
     * TODO Hide private recipes unless owner wants them.
     */
    public function index(): Response
    {
        $recipes = Recipe::all();
        return response([ "recipes" => RecipeResource::collection($recipes), "message" => "Retrieved successfully."], 200);
    }

    /**
     * @inheritDoc
     */
    public function store(Request $request): Response
    {
        //TODO Variable validation.
        $recipe = Recipe::create($request->all());

        return response(["recipe" => new RecipeResource($recipe), "message" => "$recipe->name created successfully"], 201);
    }

    /**
     * @inheritDoc
     *
     * TODO Hide private recipes unless owner wants them.
     * TODO Add include owner and style.
     */
    public function show(Recipe $recipe): Response
    {
        return response(["recipe" => new RecipeResource($recipe), "message" => "$recipe->name retrieved successfully"], 200);
    }

    /**
     * @inheritDoc
     */
    public function update(Request $request, Recipe $recipe): Response
    {
        $recipe->update($request->all());

        return response(["recipe" => new RecipeResource($recipe), "message" => "$recipe->name updated successfully."], 200);

    }

    /**
     * @inheritDoc
     */
    public function destroy(Recipe $recipe): Response
    {
        $recipe->delete();

        return response(["message" => "$recipe->name deleted"], 200);
    }
}
