<?php

namespace App\Repositories\Contracts;

use App\Enums\GameState;
use App\Models\Game;

interface GameRepositoryInterface
{
    public function getActiveGame();

    public function getLatestGame();

    public function createNewGame(): Game;

    public function updateGameStatus(GameState $state);

    public function getScoreForState(GameState $state): int;
}