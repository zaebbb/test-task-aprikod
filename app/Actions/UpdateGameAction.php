<?php

namespace App\Actions;

use App\Helper\Helper;
use App\Models\Game;
use App\Models\GameGenre;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateGameAction
{
    public static function updateGame(Request $request, int $id): array
    {
        $game = Helper::isExistsGame($id);

        if(!$game["status"]){
            return [
                "data" => [
                    "message" => "Игра не найдена"
                ],
                "code" => 404
            ];
        }

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

        $game["data"]->update([
            "title" => $request->title,
            "studio" => $request->studio
        ]);

        DeleteGameGenreAction::deleteGameGenres($game["data"]->id);

        foreach($request->genres as $genre){
            $searchGenre = Genre::find($genre);

            if(!is_null($searchGenre)){
                GameGenre::create([
                    "game_id" => $game["data"]->id,
                    "genre_id" => $searchGenre->id
                ]);
            }
        }

        return [
            "data" => [
                "id" => $game["data"]->id,
                "title" => $game["data"]->title,
                "studio" => $game["data"]->studio,
                "genres" => $game["data"]->genres,
            ],
            "code" => 201
        ];
    }
}
