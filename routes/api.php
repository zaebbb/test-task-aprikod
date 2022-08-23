<?php

use App\Http\Controllers\GameController;
use App\Http\Controllers\GenreController;
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

Route::get("/genre", [GenreController::class, "index"]);
Route::get("/genre/{id}", [GenreController::class, "view"]);
Route::post("/genre/create", [GenreController::class, "create"]);
Route::post("/genre/{id}/update", [GenreController::class, "update"]);
Route::get("/genre/{id}/delete", [GenreController::class, "delete"]);

Route::get("/genre/{id}/games", [GenreController::class, "viewGames"]);

Route::get("/games", [GameController::class, "index"]);
Route::get("/games/{id}", [GameController::class, "view"]);
Route::post("/games/create", [GameController::class, "create"]);
Route::post("/games/{id}/update", [GameController::class, "update"]);
Route::get("/games/{id}/delete", [GameController::class, "delete"]);
