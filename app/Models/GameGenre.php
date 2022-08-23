<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameGenre extends Model
{
    use HasFactory;

    protected $table = "game_genre";

    protected $fillable = [
        "game_id",
        "genre_id"
    ];
}
