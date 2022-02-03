<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProbeStateResource;
use App\Http\Resources\Objects\ProbeStateResourceObject;
use App\Http\Resources\ProbeStateCollection;
use App\Models\ProbeState;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

/**
 * This class will get a massive overhaul in Sprint 9 (BREWDICT-28).
 */
class ProbeStateController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(ProbeState::class);
    }

    public function index(): Response
    {
        $probeStates = ProbeState::all();
        return response(new ProbeStateCollection($probeStates), 200);
    }

    public function store(Request $request): Response
    {
        //TODO Variable validation.
        $probeState = ProbeState::create($request->all());

        return response(new ProbeStateResourceObject($probeState), 201);
    }

    public function show(ProbeState $probeState): Response
    {
        return response(new ProbeStateResource($probeState), 200);
    }

    public function update(Request $request, ProbeState $probeState): Response
    {
        $probeState->update($request->all());

        return response(new ProbeStateResourceObject($probeState), 200);

    }

    public function destroy(ProbeState $probeState): Response
    {
        $probeState->delete();

        return response([], 200);
    }
}
