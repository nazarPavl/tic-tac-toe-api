<?php

namespace App\Repositories\Contracts;

use App\Models\Game;

interface GameRepositoryInterface
{
    public function getActiveGame();

    public function getLatestGame();

    public function createNewGame(): Game;
}