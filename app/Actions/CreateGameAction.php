<?php

namespace App\Actions;

use App\Models\Game;
use App\Models\GameGenre;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CreateGameAction
{
    public static function createGame(Request $request): array
    {
        $validateData = Validator::make($request->all(),
            [
                "title" => "required|min:3|max:255|unique:games",
                "studio" => "required|min:3|max:255",
                "genres" => "required|array|min:1"
            ],
            [
                "title.required" => "Заголовок игры должен быть не пустым",
                "title.min" => "Минимальная длина заголовка 3 символа",
                "title.max" => "Максимальная длина заголовка 255 символов",
                "title.unique" => "Такая игра уже существует",

                "studio.required" => "Студия-разработчик должна быть не пустой",
                "studio.min" => "Минимальная длина заголовка 3 символа",
                "studio.max" => "Максимальная длина заголовка 255 символов",

                "genres.required" => "Список жанров обязателен к заполнению",
                "genres.array" => "Передан список жанров некорректного формата",
                "genres.min" => "Передан пустой список жанров",
            ]
        );

        if($validateData->fails()){
            return [
                "data" => $validateData->errors(),
                "code" => 400
            ];
        }

        $game = Game::create([
            "title" => $request->title,
            "studio" => $request->studio
        ]);

        foreach($request->genres as $genre){
            $searchGenre = Genre::find($genre);

            if(!is_null($searchGenre)){
                GameGenre::create([
                    "game_id" => $game->id,
                    "genre_id" => $searchGenre->id
                ]);
            }
        }

        return [
            "data" => [
                "id" => $game->id,
                "title" => $game->title,
                "studio" => $game->studio,
                "genres" => $game->genres,
            ],
            "code" => 201
        ];
    }
}
