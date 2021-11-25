<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StyleCategoryResource;
use App\Models\StyleCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StyleCategoryController extends Controller
{
    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        $styleCategorys = StyleCategory::all();
        return response([ "styleCategorys" => StyleCategoryResource::collection($styleCategorys), "message" => "Retrieved successfully."], 200);
    }

    /**
     * @inheritDoc
     */
    public function store(Request $request): Response
    {
        //TODO Variable validation.
        $styleCategory = StyleCategory::create($request->all());

        return response(["styleCategory" => new StyleCategoryResource($styleCategory), "message" => "$styleCategory->name created successfully"], 201);
    }

    /**
     * @inheritDoc
     */
    public function show(StyleCategory $styleCategory): Response
    {
        return response(["styleCategory" => new StyleCategoryResource($styleCategory), "message" => "$styleCategory->name retrieved successfully"], 200);
    }

    /**
     * @inheritDoc
     */
    public function update(Request $request, StyleCategory $styleCategory): Response
    {
        $styleCategory->update($request->all());

        return response(["styleCategory" => new StyleCategoryResource($styleCategory), "message" => "$styleCategory->name updated successfully."], 200);

    }

    /**
     * @inheritDoc
     */
    public function destroy(StyleCategory $styleCategory): Response
    {
        $styleCategory->delete();

        return response(["message" => "$styleCategory->name deleted"], 200);
    }
}
