<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Objects\StyleResourceObject;
use App\Http\Resources\StyleCollection;
use App\Http\Resources\StyleResource;
use App\Models\Style;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StyleController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Style::class);
    }

    /**
     * TODO Add include style category.
     */
    public function index(): Response
    {
        $styles = Style::all();
        return response(new StyleCollection($styles), 200);
    }

    public function store(Request $request): Response
    {
        //TODO Variable validation.
        $style = Style::create($request->all());

        return response(new StyleResourceObject($style), 201);
    }

    public function show(Style $style): Response
    {
        return response(new StyleResource($style), 200);
    }

    public function update(Request $request, Style $style): Response
    {
        $style->update($request->all());

        return response(new StyleResourceObject($style), 200);

    }

    public function destroy(Style $style): Response
    {
        $style->delete();

        return response([], 200);
    }
}
