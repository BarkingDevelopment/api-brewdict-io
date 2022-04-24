<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReadingObject;
use App\Http\Resources\ReadingResource;
use App\Models\Fermentation;
use App\Models\Reading;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;


/**
 * This class will get a massive overhaul in Sprint 9 (BREWDICT-28).
 */
class ReadingController extends Controller
{
    // BUG: Policy disabled due to some actions being denied when they shouldn't be.
    public function __construct()
    {
        $this->authorizeResource(Reading::class);
    }

    public function index(Fermentation $fermentation): Response
    {
        $readings = Reading::where("fermentation_id", $fermentation->id);
        return response(ReadingObject::collection($readings), 200);
    }

    /**
     * TODO Adaptor for type of probe.
     * TODO Entry value and unit verification.
     */
    public function store(Fermentation $fermentation, Request $request): Response
    {
        $validator = Validator::make($request->all(), [
            "type" => "required|alpha",
            "recorded_at" => "required|date",
            "value" => "required|numeric",
            "units" => "required|alpha_num",
        ]);

        if ($validator->fails())
        {
            return response(["errors" => $validator->errors()->all()], 422);
        }

        $reading = Reading::create([
            "fermentation_id" => $fermentation->id,
            "type" => $request->type,
            "recorded_at" => $request->recorded_at,
            "value" => $request->value,
            "units" => $request->units

        ]);

        return response(new ReadingResource($reading), 201);
    }

    public function show(Reading $reading): Response
    {
        return response(new ReadingResource($reading), 200);
    }

    public function update(Request $request, Reading $reading): Response
    {
        $reading->update($request->all());

        return response(new ReadingResource($reading), 200);
    }

    public function destroy(Reading $reading): Response
    {
        $reading->delete();

        return response([],204);
    }
}
