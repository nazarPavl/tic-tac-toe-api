<?php

namespace App\Repositories\Contracts;

use App\Enums\Player;
use App\Models\GameMove;

interface GameMoveRepositoryInterface
{
    public function createNewMove(int $gameId, Player $player, int $x, int $y): GameMove;
}