<?php

use App\Http\Controllers\API\FermentationController;
use App\Http\Controllers\API\ProbeController;
use App\Http\Controllers\API\ProbeStateController;
use App\Http\Controllers\API\ReadingController;
use App\Http\Controllers\API\RecipeController;
use App\Http\Controllers\API\StyleCategoryController;
use App\Http\Controllers\API\StyleController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("users", UserController::class, ["except" => ["index", "store"]]); //TODO Policy
Route::apiResource("users.recipes", RecipeController::class)->shallow(); //TODO Policy to private recipes.
Route::apiResource("users.recipes.fermentations", FermentationController::class, ["except" => ["update", "destroy"]]); //TODO Policy
Route::post("fermentations/{ferment}/add", [FermentationController::class, "add"]);
Route::delete("fermentations/{ferment}/remove", [FermentationController::class, "remove"]);

Route::apiResource("style-category", StyleCategoryController::class);
Route::apiResource("style-category.styles", StyleController::class)->shallow();

Route::apiResource("users.probes", ProbeController::class); //TODO Policy
Route::apiResource("probes.states", ProbeStateController::class, ["except" => ["update", "destroy"]])->shallow(); //TODO Policy
Route::apiResource("fermentations.probes", ProbeController::class, ["only" => ["index", "show"]]); //TODO Policy
Route::apiResource("probes.readings", ReadingController::class, ["except" => ["show", "update", "destroy"]])->shallow(); //TODO Policy
