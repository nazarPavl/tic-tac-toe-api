<?php

namespace App\Repositories\Contracts;

use App\Enums\GameState;
use App\Models\Game;

interface GameRepositoryInterface
{
    public function getActiveGame();

    public function getLatestGame();

    public function createNewGame(): Game;

    public function updateGameStatus(int $gameId, GameState $state);

    public function truncateGames();

    public function getScoreForState(GameState $state): int;
}