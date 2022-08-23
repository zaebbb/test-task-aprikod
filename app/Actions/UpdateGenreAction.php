<?php

namespace App\Actions;

use App\Helper\Helper;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UpdateGenreAction
{
    public static function updateGenre(Request $request, int $id): array
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

        $validateData = Validator::make($request->all(),
            [
                "title" => "required|min:3|max:255|unique:genres"
            ],
            [
                "title.required" => "Заголовок жанра должен быть не пустым",
                "title.min" => "Минимальная длина заголовка 3 символа",
                "title.max" => "Максимальная длина заголовка 255 символов",
                "title.unique" => "Такой жанр уже существует",
            ]
        );

        if($validateData->fails()){
            return [
                "data" => $validateData->errors(),
                "code" => 400
            ];
        }

        $genre["data"]->update([
            "title" => $request->title
        ]);

        return [
            "data" => $genre["data"],
            "code" => 201
        ];
    }
}
