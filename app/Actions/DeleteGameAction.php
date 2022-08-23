<?php

namespace App\Actions;

use App\Helper\Helper;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeleteGameAction
{
    public static function deleteGame(int $id): array
    {
        $game = Helper::isExistsGame($id);

        if(!$game["status"]){
            return [
                "data" => [
                    "message" => $game["data"]
                ],
                "code" => 404
            ];
        }

        $game["data"]->delete();

        return [
            "data" => [
                "message" => "Игра успешно удалена"
            ],
            "code" => 201
        ];
    }
}
