<?php

namespace App\Http\Controllers;

use App\Actions\CreateGameAction;
use App\Actions\CreateGenreAction;
use App\Actions\DeleteGameAction;
use App\Actions\DeleteGenreAction;
use App\Actions\UpdateGameAction;
use App\Actions\ViewGameAction;
use App\Actions\ViewGamesAllAction;
use App\Helper\Helper;
use App\Models\Game;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GameController extends Controller
{

    public function index(): JsonResponse
    {
        $game = ViewGamesAllAction::viewGamesAll();

        return Helper::response($game, 200);
    }

    public function view($id): JsonResponse
    {
        $game = ViewGameAction::searchOneGame($id);

        return Helper::response($game["data"], $game["code"]);
    }

    public function create(Request $request): JsonResponse
    {
        $genreCreate = CreateGameAction::createGame($request);

        return Helper::response($genreCreate["data"], $genreCreate["code"]);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $genreUpdate = UpdateGameAction::updateGame($request, $id);

        return Helper::response($genreUpdate["data"], $genreUpdate["code"]);
    }

    public function delete($id): JsonResponse
    {
        $gameDelete = DeleteGameAction::deleteGame($id);

        return Helper::response($gameDelete["data"], $gameDelete["code"]);
    }
}
