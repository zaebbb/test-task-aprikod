<?php

namespace App\Helper;

use App\Models\Game;
use App\Models\Genre;

class Helper
{
    public static function response(array | object $data, int $statusCode)
    {
        return response()
            ->json($data)
            ->setStatusCode($statusCode);
    }

    public static function isExistsGenre(int $id): array
    {
        $genre = Genre::find($id);

        if(is_null($genre)){
            return [
                "status" => false,
                "data" => "Жанр не найден"
            ];
        }

        return [
            "status" => true,
            "data" => $genre
        ];
    }

    public static function isExistsGame(int $id): array
    {
        $game = Game::find($id);

        if(is_null($game)){
            return [
                "status" => false,
                "data" => "Игра не найдена"
            ];
        }

        return [
            "status" => true,
            "data" => $game
        ];
    }

    public static function editAllGames(object $games): array
    {
        $gamesGenres = [];

        foreach($games as $game){
            $gamesGenres[] = [
                "id" => $game->id,
                "title" => $game->title,
                "studio" => $game->studio,
                "genres" => $game->genres,
            ];
        }

        return $gamesGenres;
    }
}
