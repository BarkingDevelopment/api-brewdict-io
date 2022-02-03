<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Objects\RecipeResourceObject;
use App\Http\Resources\RecipeCollection;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

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

    /**
     * TODO Hide private recipes unless owner wants them.
     */
    public function index(): Response
    {
        $recipes = Recipe::all();
        return response(new RecipeCollection($recipes), 200);
    }

    public function store(Request $request): Response
    {
        //TODO Variable validation.
        $recipe = Recipe::create($request->all());

        return response(new RecipeResourceObject($recipe), 201);
    }

    /**
     * TODO Hide private recipes unless owner wants them.
     * TODO Add include owner and style.
     */
    public function show(Recipe $recipe): Response
    {
        return response(new RecipeResource($recipe), 200);
    }

    public function update(Request $request, Recipe $recipe): Response
    {
        $recipe->update($request->all());

        return response(new RecipeResourceObject($recipe), 200);

    }

    public function destroy(Recipe $recipe): Response
    {
        $recipe->delete();

        return response([], 200);
    }
}
