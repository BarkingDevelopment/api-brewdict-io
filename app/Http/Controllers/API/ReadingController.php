<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Objects\ReadingResourceObject;
use App\Http\Resources\Collections\ReadingCollection;
use App\Http\Resources\ReadingResource;
use App\Models\Reading;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


/**
 * This class will get a massive overhaul in Sprint 9 (BREWDICT-28).
 */
class ReadingController extends Controller
{
    /*
     * BUG: Policy disabled due to some actions being denied when they shouldn't be.
    public function __construct()
    {
        $this->authorizeResource(Reading::class);
    }
    */

    public function index(): Response
    {
        $readings = Reading::all();
        return response(new ReadingCollection($readings), 200);
    }

    /**
     * TODO Adaptor for type of probe.
     * TODO Entry value and unit verification.
     */
    public function store(Request $request): Response
    {
        $reading = Reading::create($request->all());

        return response(new ReadingResourceObject($reading), 201);
    }

    public function show(Reading $reading): Response
    {
        return response(new ReadingResource($reading), 200);
    }

    public function update(Request $request, Reading $reading): Response
    {
        $reading->update($request->all());

        return response(new ReadingResourceObject($reading), 200);
    }

    public function destroy(Reading $reading): Response
    {
        $reading->delete();

        return response([],204);
    }
}
