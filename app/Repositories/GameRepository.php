<?php

namespace App\Repositories;

use App\Enums\GameState;
use App\Enums\Player;
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

    public function updateGameStatus(GameState $state)
    {
        return $this->game->where('state', $state)
            ->update(['state' => $state]);
    }

    public function getScoreForState(GameState $state): int
    {
        return $this->game::where('state', $state->value)->count();
    }
}