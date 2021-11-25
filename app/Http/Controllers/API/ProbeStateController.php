<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProbeStateResource;
use App\Models\ProbeState;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * This class will get a massive overhaul in Sprint 9 (BREWDICT-28).
 */
class ProbeStateController extends Controller
{
    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        $probeStates = ProbeState::all();
        return response([ "probeStates" => ProbeStateResource::collection($probeStates), "message" => "Retrieved successfully."], 200);
    }

    /**
     * @inheritDoc
     */
    public function store(Request $request): Response
    {
        //TODO Variable validation.
        $probeState = ProbeState::create($request->all());

        return response(["probeState" => new ProbeStateResource($probeState), "message" => "$probeState- created successfully"], 201);
    }

    /**
     * @inheritDoc
     */
    public function show(ProbeState $probeState): Response
    {
        return response(["probeState" => new ProbeStateResource($probeState), "message" => "$probeState retrieved successfully"], 200);
    }

    /**
     * @inheritDoc
     */
    public function update(Request $request, ProbeState $probeState): Response
    {
        $probeState->update($request->all());

        return response(["probeState" => new ProbeStateResource($probeState), "message" => "$probeState updated successfully."], 200);

    }

    /**
     * @inheritDoc
     */
    public function destroy(ProbeState $probeState): Response
    {
        $probeState->delete();

        return response(["message" => "$probeState deleted"], 200);
    }
}
