<?php

use App\Http\Controllers\API\FermentationController;
use App\Http\Controllers\API\ProbeController;
use App\Http\Controllers\API\ProbeStateController;
use App\Http\Controllers\API\ReadingController;
use App\Http\Controllers\API\RecipeController;
use App\Http\Controllers\API\StyleCategoryController;
use App\Http\Controllers\API\StyleController;
use App\Http\Controllers\ApiAuthController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware("auth:api")->get("/user", function (Request $request) {
    return $request->user();
});

Route::group(["middleware" => ["cors", "json.response"]], function () {
    Route::post("users/register", [ApiAuthController::class, "register"])->name("register.api");
    Route::post("login", [ApiAuthController::class, "login"])->name("login.api");


    Route::middleware("auth:api")->group(function() {
        Route::post("logout", [ApiAuthController::class, "logout"])->name("logout.api");

        Route::apiResource("users", UserController::class, ["except" => ["index", "store"]]);
        Route::apiResource("users.recipes", RecipeController::class, ["except" => ["index", "show"]])->shallow();

        Route::apiResource("users.fermentations", FermentationController::class, ["except" => ["update"]])->shallow();
        Route::apiResource("fermentations.probes", ProbeController::class, ["only" => ["index", "show"]]);
        Route::apiResource("fermentations.readings", ReadingController::class, ["except" => ["show", "update"]])->shallow();
        Route::put("fermentations/{fermentation}/start", [FermentationController::class, "start"]);
        Route::put("fermentations/{fermentation}/complete", [FermentationController::class, "start"]);
        Route::post("fermentations/{fermentation}/probes/add", [FermentationController::class, "add"]);
        Route::delete("fermentations/{fermentation}/probes/remove", [FermentationController::class, "remove"]);

        Route::apiResource("users.probes", ProbeController::class)->shallow();
        Route::apiResource("probes.states", ProbeStateController::class, ["except" => ["update", "destroy"]])->shallow();
        //Route::apiResource("probes.readings", ReadingController::class, ["except" => ["show", "update", "destroy"]])->shallow();
    });

    Route::get("recipes", [RecipeController::class, 'index']);
    Route::apiResource("users.recipes", RecipeController::class, ["only" => ["index", "show"]])->shallow();
    Route::apiResource("style-category", StyleCategoryController::class);
    Route::get("styles", [StyleController::class, "index"]);
    Route::apiResource("style-category.styles", StyleController::class)->shallow();
});
