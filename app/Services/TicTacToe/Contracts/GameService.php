<?php

namespace App\Services\TicTacToe\Contracts;

use App\Models\Game;

interface GameService
{
    public function initializeGame();

    public function activeGame();

    public function buildTicTacToeGame(Game $game);

    public function makeMove(string $player, int $x, int $y);

    public function state();

    public function restart();
}