<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReadingResource;
use App\Models\Reading;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


/**
 * This class will get a massive overhaul in Sprint 9 (BREWDICT-28).
 */
class ReadingController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Reading::class);
    }

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        $readings = Reading::all();
        return response([ "readings" => ReadingResource::collection($readings), "message" => "Retrieved successfully."], 200);
    }

    /**
     * @inheritDoc
     *
     * TODO Adaptor for type of probe.
     * TODO Entry value and unit verification.
     */
    public function store(Request $request): Response
    {
        $reading = Reading::create($request->all());

        return response(["reading" => new ReadingResource($reading), "message" => "$reading->id created successfully"], 201);
    }

    /**
     * @inheritDoc
     */
    public function show(Reading $reading): Response
    {
        return response(["reading" => new ReadingResource($reading), "message" => "$reading->id retrieved successfully"], 200);
    }

    /**
     * @inheritDoc
     */
    public function update(Request $request, Reading $reading): Response
    {
        $reading->update($request->all());

        return response(["reading" => new ReadingResource($reading), "message" => "$reading->id updated successfully."], 200);

    }

    /**
     * @inheritDoc
     */
    public function destroy(Reading $reading): Response
    {
        $reading->delete();

        return response(["message" => "$reading->id deleted"], 200);
    }
}
