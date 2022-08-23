<?php

namespace App\Actions;

use App\Helper\Helper;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeleteGenreAction
{
    public static function deleteGenre(int $id): array
    {
        $genre = Helper::isExistsGenre($id);

        if(!$genre["status"]){
            return [
                "data" => [
                    "message" => $genre["data"]
                ],
                "code" => 404
            ];
        }

        $genre["data"]->delete();

        return [
            "data" => [
                "message" => "Жанр успешно удален"
            ],
            "code" => 201
        ];
    }
}
