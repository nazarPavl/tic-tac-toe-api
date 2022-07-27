<?php

namespace App\Repositories;

use App\Enums\GameState;
use App\Models\Game;
use App\Repositories\Contracts\GameRepositoryInterface;

class GameRepository implements GameRepositoryInterface
{
    public function __construct(
        private Game $game
    )
    {
        
    }

    public function getActiveGame()
    {
        return $this->game::with('moves')->where('state', GameState::Active->value)
            ->first();
    }

    public function getLatestGame()
    {
        return $this->game::latest('id')->first();
    }

    public function createNewGame(): Game
    {
        return $this->game::create([
            'state' => GameState::Active
        ]);
    }
}