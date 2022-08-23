<?php

namespace App\Http\Controllers;

use App\Actions\CreateGenreAction;
use App\Actions\DeleteGenreAction;
use App\Actions\UpdateGenreAction;
use App\Actions\ViewGenreAction;
use App\Actions\ViewGenreGamesAction;
use App\Helper\Helper;
use App\Models\Genre;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class GenreController extends Controller
{

    public function index(): JsonResponse
    {
        $genre = Genre::all();

        return Helper::response($genre, 200);
    }


    public function view(int $id): JsonResponse
    {
        $genre = ViewGenreAction::searchOneGenre($id);

        return Helper::response($genre["data"], $genre["code"]);
    }


    public function create(Request $request): JsonResponse
    {
        $genreCreate = CreateGenreAction::createGenre($request);

        return Helper::response($genreCreate["data"], $genreCreate["code"]);
    }


    public function update(Request $request, int $id): JsonResponse
    {
        $genreUpdate = UpdateGenreAction::updateGenre($request, $id);

        return Helper::response($genreUpdate["data"], $genreUpdate["code"]);
    }


    public function delete(int $id): JsonResponse
    {
        $genreDelete = DeleteGenreAction::deleteGenre($id);

        return Helper::response($genreDelete["data"], $genreDelete["code"]);
    }

    public function viewGames(int $id): JsonResponse
    {
        $genre = ViewGenreGamesAction::searchOneGenreGames($id);

        return Helper::response($genre["data"], $genre["code"]);
    }
}
