<?php

namespace App\Actions;

use App\Helper\Helper;
use App\Models\Game;
use App\Models\Genre;

class ViewGamesAllAction
{
    public static function viewGamesAll(): array
    {
        return Helper::editAllGames(Game::all());
    }
}
