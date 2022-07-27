<?php

namespace App\Models;

use App\Enums\GameState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */
    protected $with = ['moves'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['state'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'state' => GameState::class,
    ];

    /**
     * Get the moves for the game.
     */
    public function moves()
    {
        return $this->hasMany(GameMove::class);
    }
}