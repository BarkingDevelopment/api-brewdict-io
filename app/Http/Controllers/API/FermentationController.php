<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\FermentationObject;
use App\Http\Resources\FermentationResource;
use App\Models\Fermentation;
use App\Models\ProbeAssignment;
use App\Models\Probe;
use App\Models\Reading;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class FermentationController extends Controller
{
    /*
    public function __construct()
    {
        $this->authorizeResource(Fermentation::class);
    }
    */


    public function index(User $user): Response
    {
        $fermentations = Fermentation::where("brewed_by", $user->id)->get();
        return response(FermentationObject::collection($fermentations), 200);
    }

    public function store(Request $request, User $user): Response
    {
        $validator = Validator::make($request->all(), [
            "recipe_id" => "required|exists:recipes,id",
            "brewed_by" => "prohibited",
            "equipment_id" => "prohibited",
            "started_at" => "prohibited",
            "completed" => "prohibited"
        ]);

        if ($validator->fails())
        {
            return response(["errors" => $validator->errors()->all()], 422);
        }

        $ferment = Fermentation::create([
            "recipe_id" => $request->recipe_id,
            "brewed_by" => $user->id
        ]);

        return response( new FermentationResource($ferment), 201);
    }

    public function show(Fermentation $fermentation): Response
    {
        return response(new FermentationResource($fermentation), 200);
    }

    public function update(Request $request, Fermentation $fermentation): Response
    {
        if (!$fermentation->exists()) return response(["errors" => ["The selected fermentation id is invalid."]], 404);

        /**
         * Update path currently disabled via routing.
         * If the fermentation ever needs to be updated, the validator here can be changed.
         */
        $validator = Validator::make($request->all(), [
            "recipe_id" => "prohibited",
            "brewed_by" => "prohibited",
            "equipment_id" => "prohibited",
            "started_at" => "prohibited",
        ]);

        if ($validator->fails()) return response(["errors" => $validator->errors()->all()], 422);

        $fermentation->update($request->all());

        return response(new FermentationResource($fermentation), 200);
    }

    public function destroy(Fermentation $fermentation): Response
    {
        $fermentation->delete();

        return response([], 204);
    }

    /**
     * @param Fermentation $fermentation
     */
    public function start(Request $request, Fermentation $fermentation)
    {
        if (is_null($fermentation->started_at))
        {
            $validator = Validator::make($request->all(), [
                "og" => "required|numeric|min:1|max:2",
                "temp" => "required|numeric"
            ]);

            if ($validator->fails()) return response(["errors" => $validator->errors()->all()], 422);

            $fermentation->update([
                "started_at" => date('Y-m-d H:i:s'),
                "og" => $request->og
            ]);

            Reading::create([
                "fermentation_id" => $fermentation->id,
                "type" => "density",
                "recorded_at" => date('Y-m-d H:i:s'),
                "value" => $request->og,
                "units" => "SG"
            ]);

            Reading::create([
                "fermentation_id" => $fermentation->id,
                "type" => "temperature",
                "recorded_at" => date('Y-m-d H:i:s'),
                "value" => $request->temp,
                "units" => "C"
            ]);

            return response(new FermentationResource($fermentation), 200);
        }
        else {
            return response(["errors" => ["Fermentation already started."]], 403);
        }
    }

    public function complete(Fermentation $fermentation)
    {
        if (is_null($fermentation->started_at))
        {
            return response(["errors" => ["Fermentation not started started."]], 403);
        }
        else {
            if ($fermentation->completed){
                return response(["errors" => ["Fermentation already complete."]], 403);
            } else{
                $fermentation->update([
                    "started_at" => date('Y-m-d H:i:s')
                ]);

                return response(new FermentationResource($fermentation), 200);
            }
        }
    }

    /**
     * Adds a probe to a ferment.
     *
     * @param Request $request
     * @param Fermentation $ferment
     * @return Application|ResponseFactory|Response
     */
    public function add(Request $request, Fermentation $fermentation)
    {
        $probe = $this->getProbe($request);

        if(ProbeAssignment::where("probe_id", $probe->id)->count() === 0 ) {
            $probe_assign = new ProbeAssignment();
            $probe_assign->fermentation_id = $fermentation->id;
            $probe_assign->probe_id = $probe->id;
            $probe_assign->save();

            return response(new FermentationResource($probe), 201);
        }
        else{
            return response(new FermentationResource($probe), 409);
        }
    }

    /**
     * Removes a probe from a ferment.
     *
     * @param Request $request
     * @param Fermentation $ferment
     * @return Application|ResponseFactory|Response
     */
    public function remove(Request $request, Fermentation $fermentation)
    {
        $probe = $this->getProbe($request);

        ProbeAssignment::where("fermentation_id", $fermentation->id)
                        ->where("probe_id", $probe->id)
                        ->delete();

        return response(new FermentationResource($probe), 200);
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
