<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FermentationResource;
use App\Models\Fermentation;
use App\Models\ProbeAssignment;
use App\Models\Probe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FermentationController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Fermentation::class);
    }

    /**
     * @inheritDoc
     */
    public function index(): Response
    {
        $ferments = Fermentation::all();
        return response([ "ferments" => FermentationResource::collection($ferments), "message" => "Retrieved successfully."], 200);
    }

    /**
     * @inheritDoc
     */
    public function store(Request $request): Response
    {
        //TODO Variable validation.
        $ferment = Fermentation::create($request->all());
        $name = $ferment->recipe()->name;

        return response(["ferment" => new FermentationResource($ferment), "message" => "$name ferment created successfully"], 201);
    }

    /**
     * @inheritDoc
     *
     * TODO Add include recipe.
     */
    public function show(Fermentation $ferment): Response
    {
        $name = $ferment->recipe()->name;

        return response(["ferment" => new FermentationResource($ferment), "message" => "$name ferment retrieved successfully"], 200);
    }

    /**
     * @inheritDoc
     */
    public function update(Request $request, Fermentation $ferment): Response
    {
        $ferment->update($request->all());
        $name = $ferment->recipe()->name;

        return response(["ferment" => new FermentationResource($ferment), "message" => "$name ferment updated successfully."], 200);

    }

    /**
     * @inheritDoc
     */
    public function destroy(Fermentation $ferment): Response
    {
        $name = $ferment->recipe()->name;
        $ferment->delete();

        return response(["message" => "$name ferment deleted"], 200);
    }


    /**
     * Adds a probe to a ferment.
     *
     * @param Request $request
     * @param Fermentation $ferment
     */
    public function add(Request $request, Fermentation $ferment)
    {
        $probe = $this->getProbe($request);

        if(ProbeAssignment::where("probe_id", $probe->id)->count() === 0 ) {
            $probe_assign = new ProbeAssignment();
            $probe_assign->fermentation_id = $ferment->id;
            $probe_assign->probe_id = $probe->id;
            $probe_assign->save();

            return response(["message" => "$probe->name assigned to $ferment->id successfully."], 201);
        }
        else{
            return response(["message" => "$probe->name is already assigned to a fermentation."], 409);
        }
    }

    /**
     * Removes a probe from a ferment.
     *
     * @param Request $request
     * @param Fermentation $ferment
     */
    public function remove(Request $request, Fermentation $ferment)
    {
        $probe = $this->getProbe($request);

        ProbeAssignment::where("fermentation_id", $ferment->id)
                        ->where("probe_id", $probe->id)
                        ->delete();

        return response(["message" => "$probe->name successfully deleted from $ferment->id."], 200);
    }

    private function getProbe(Request $request)
    {
        $probe_id = $request->input("id");

        return Probe::where("id", $probe_id);
    }
}
