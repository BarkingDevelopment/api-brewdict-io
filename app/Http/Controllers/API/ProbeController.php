<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProbeResource;
use App\Models\Probe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


/**
 * This class will get a massive overhaul in Sprint 8 (BREWDICT-27).
 */
class ProbeController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Probe::class);
    }

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        $probes = Probe::all();
        return response([ "probes" => ProbeResource::collection($probes), "message" => "Retrieved successfully."], 200);
    }

    /**
     * @inheritDoc
     */
    public function store(Request $request): Response
    {
        $probe = Probe::create($request->all());

        return response(["probe" => new ProbeResource($probe), "message" => "$probe->name created successfully"], 201);
    }

    /**
     * @inheritDoc
     *
     * TODO Add last probe state and reading to JSON.
     */
    public function show(Probe $probe): Response
    {
        return response(["probe" => new ProbeResource($probe), "message" => "$probe->name retrieved successfully"], 200);
    }

    /**
     * @inheritDoc
     */
    public function update(Request $request, Probe $probe): Response
    {
        $probe->update($request->all());

        return response(["probe" => new ProbeResource($probe), "message" => "$probe->name updated successfully."], 200);

    }

    /**
     * @inheritDoc
     */
    public function destroy(Probe $probe): Response
    {
        $probe->delete();

        return response(["message" => "$probe->name deleted"], 200);
    }
}
