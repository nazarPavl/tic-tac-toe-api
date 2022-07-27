<?php

namespace App\Models;

use App\Enums\Player;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GameMove extends Model
{
    use HasFactory;

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'player' => Player::class,
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'game_id',
        'player',
        'x',
        'y'
    ];
}