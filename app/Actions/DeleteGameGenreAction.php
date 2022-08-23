<?php

namespace App\Actions;

use App\Helper\Helper;
use App\Models\GameGenre;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeleteGameGenreAction
{
    public static function deleteGameGenres(int $game_id): bool
    {
        $gameGenre = GameGenre::where("game_id", $game_id)->get();

        foreach($gameGenre as $item){
            $item->delete();
        }

        return true;
    }
}
