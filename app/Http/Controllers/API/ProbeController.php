<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\Objects\ProbeResourceObject;
use App\Http\Resources\Collections\ProbeCollection;
use App\Http\Resources\ProbeResource;
use App\Models\Probe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


/**
 * This class will get a massive overhaul in Sprint 8 (BREWDICT-27).
 */
class ProbeController extends Controller
{
    /*
     * BUG: Policy disabled due to some actions being denied when they shouldn't be.
    public function __construct()
    {
        $this->authorizeResource(Probe::class);
    }
    */

    /**
     * @return Response
     */
    public function index(): Response
    {
        $probes = Probe::all();
        return response(new ProbeCollection($probes), 200);
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $probe = Probe::create($request->all());

        return response(new ProbeResourceObject($probe), 201);
    }

    /**
     * @param Probe $probe
     * @return Response
     */
    public function show(Probe $probe): Response
    {
        return response(new ProbeResource($probe), 200);
    }

    /**
     * @param Request $request
     * @param Probe $probe
     * @return Response
     */
    public function update(Request $request, Probe $probe): Response
    {
        $probe->update($request->all());

        return response(["message" => "$probe->name updated successfully.", "probe" => new ProbeResource($probe)], 200);
    }

    /**
     * @param Probe $probe
     * @return Response
     */
    public function destroy(Probe $probe): Response
    {
        $probe->delete();

        return response(["message" => "$probe->name deleted"], 200);
    }
}
