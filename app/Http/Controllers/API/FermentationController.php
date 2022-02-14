<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FermentationCollection;
use App\Http\Resources\FermentationResource;
use App\Http\Resources\Objects\FermentationResourceObject;
use App\Http\Resources\Objects\ProbeResourceObject;
use App\Models\Fermentation;
use App\Models\ProbeAssignment;
use App\Models\Probe;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FermentationController extends Controller
{
    /*
     * BUG: Policy disabled due to some actions being denied when they shouldn't be.
    public function __construct()
    {
        $this->authorizeResource(Fermentation::class);
    }
    */

    public function index(): Response
    {
        $ferments = Fermentation::all();
        return response(new FermentationCollection($ferments), 200);
    }

    public function store(Request $request): Response
    {
        //TODO Variable validation.
        $ferment = Fermentation::create($request->all());

        return response( new FermentationResourceObject($ferment), 201);
    }

    /**
     * TODO Add include recipe.
     */
    public function show(Fermentation $ferment): Response
    {
        return response(new FermentationResource($ferment), 200);
    }

    public function update(Request $request, Fermentation $ferment): Response
    {
        $ferment->update($request->all());

        return response(new FermentationResourceObject($ferment), 200);

    }

    public function destroy(Fermentation $ferment): Response
    {
        $ferment->delete();

        return response([], 200);
    }

    /**
     * Adds a probe to a ferment.
     *
     * @param Request $request
     * @param Fermentation $ferment
     * @return Application|ResponseFactory|Response
     */
    public function add(Request $request, Fermentation $ferment)
    {
        $probe = $this->getProbe($request);

        if(ProbeAssignment::where("probe_id", $probe->id)->count() === 0 ) {
            $probe_assign = new ProbeAssignment();
            $probe_assign->fermentation_id = $ferment->id;
            $probe_assign->probe_id = $probe->id;
            $probe_assign->save();

            return response(new ProbeResourceObject($probe), 201);
        }
        else{
            return response(new ProbeResourceObject($probe), 409);
        }
    }

    /**
     * Removes a probe from a ferment.
     *
     * @param Request $request
     * @param Fermentation $ferment
     * @return Application|ResponseFactory|Response
     */
    public function remove(Request $request, Fermentation $ferment)
    {
        $probe = $this->getProbe($request);

        ProbeAssignment::where("fermentation_id", $ferment->id)
                        ->where("probe_id", $probe->id)
                        ->delete();

        return response(new ProbeResourceObject($probe), 200);
    }

    /**
     * Get the probe object from a request.
     *
     * @param Request $request
     * @return mixed
     */
    private function getProbe(Request $request)
    {
        $probe_id = $request->input("id");

        return Probe::where("id", $probe_id);
    }
}
