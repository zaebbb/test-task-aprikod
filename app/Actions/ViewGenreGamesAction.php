<?php

namespace App\Actions;

use App\Helper\Helper;
use App\Models\Genre;

class ViewGenreGamesAction
{
    public static function searchOneGenreGames(int $id): array
    {
        $genre = Helper::isExistsGenre($id);

        if(!$genre["status"]){
            return [
                "data" => [
                    "message" => "Жанр не найден"
                ],
                "code" => 404
            ];
        }

        return [
            "data" => [
                "id" => $genre["data"]->id,
                "title" => $genre["data"]->title,
                "games" => $genre["data"]->games,
            ],
            "code" => 200
        ];
    }
}
