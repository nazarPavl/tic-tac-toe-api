<?php

namespace App\Repositories;

use App\Enums\Player;
use App\Models\GameMove;
use App\Repositories\Contracts\GameMoveRepositoryInterface;

class GameMoveRepository implements GameMoveRepositoryInterface
{
    public function __construct(
        private GameMove $gameMove
    )
    {
        
    }

    public function createNewMove(int $gameId, Player $player, int $x, int $y): GameMove
    {
        return $this->gameMove::create([
            'game_id' => $gameId,
            'player' => $player,
            'x' => $x,
            'y' => $y
        ]);
    }
}