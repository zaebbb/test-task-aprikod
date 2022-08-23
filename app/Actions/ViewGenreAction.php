<?php

namespace App\Actions;

use App\Helper\Helper;
use App\Models\Genre;

class ViewGenreAction
{
    public static function searchOneGenre(int $id): array
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
            "data" => $genre["data"],
            "code" => 200
        ];
    }
}
