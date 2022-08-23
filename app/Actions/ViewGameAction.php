<?php

namespace App\Actions;

use App\Helper\Helper;
use App\Models\Genre;

class ViewGameAction
{
    public static function searchOneGame(int $id): array
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

        return [
            "data" => [
                "id" => $game["data"]->id,
                "title" => $game["data"]->title,
                "studio" => $game["data"]->studio,
                "genres" => $game["data"]->genres,
            ],
            "code" => 200
        ];
    }
}
