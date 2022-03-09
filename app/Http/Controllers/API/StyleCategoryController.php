<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Objects\StyleCategoryResourceObject;
use App\Http\Resources\Collections\StyleCategoryCollection;
use App\Http\Resources\StyleCategoryResource;
use App\Models\StyleCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class StyleCategoryController extends Controller
{
    /*
     * BUG: Policy disabled due to some actions being denied when they shouldn't be.
    public function __construct()
    {
        $this->authorizeResource(StyleCategory::class);
    }
    */

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        $styleCategorys = StyleCategory::all();
        return response(new StyleCategoryCollection($styleCategorys), 200);
    }

    /**
     * @inheritDoc
     */
    public function store(Request $request): Response
    {
        //TODO Variable validation.
        $styleCategory = StyleCategory::create($request->all());

        return response(new StyleCategoryResourceObject($styleCategory), 201);
    }

    /**
     * @inheritDoc
     */
    public function show(StyleCategory $styleCategory): Response
    {
        return response(new StyleCategoryResource($styleCategory), 200);
    }

    /**
     * @inheritDoc
     */
    public function update(Request $request, StyleCategory $styleCategory): Response
    {
        $styleCategory->update($request->all());

        return response(new StyleCategoryResourceObject($styleCategory), 200);

    }

    /**
     * @inheritDoc
     */
    public function destroy(StyleCategory $styleCategory): Response
    {
        $styleCategory->delete();

        return response([], 200);
    }
}
