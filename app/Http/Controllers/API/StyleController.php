<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\StyleResource;
use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StyleController extends Controller
{
    /**
     * @inheritDoc
     *
     * TODO Add include style category.
     */
    public function index(): Response
    {
        $styles = Style::all();
        return response([ "styles" => StyleResource::collection($styles), "message" => "Retrieved successfully."], 200);
    }

    /**
     * @inheritDoc
     */
    public function store(Request $request): Response
    {
        //TODO Variable validation.
        $style = Style::create($request->all());

        return response(["style" => new StyleResource($style), "message" => "$style->name created successfully"], 201);
    }

    /**
     * @inheritDoc
     *
     * TODO Add include style category.
     */
    public function show(Style $style): Response
    {
        return response(["style" => new StyleResource($style), "message" => "$style->name retrieved successfully"], 200);
    }

    /**
     * @inheritDoc
     */
    public function update(Request $request, Style $style): Response
    {
        $style->update($request->all());

        return response(["style" => new StyleResource($style), "message" => "$style->name updated successfully."], 200);

    }

    /**
     * @inheritDoc
     */
    public function destroy(Style $style): Response
    {
        $style->delete();

        return response(["message" => "$style->name deleted"], 200);
    }
}
