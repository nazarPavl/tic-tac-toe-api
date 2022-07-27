<?php

namespace App\Services\TicTacToe;

use App\Enums\Player;
use App\Services\TicTacToe\PlayerCoordinates;
use Exception;

class TicTacToeGame
{
    private array $board;

    private ?Player $currentPlayer = null;

    public function __construct(

    )
    {
        $this->board = [
            ['', '', ''],
            ['', '', ''],
            ['', '', '']
        ];
    }

    public function initialize(PlayerCoordinates ...$coordinates) 
    {
        foreach ($coordinates as $coordinate) {
            $this->board[$coordinate->getY()][$coordinate->getX()] = $coordinate->getPlayer()->name;
        }
    }

    public function getEmptyBoard()
    {
        // 
    }

    public function getBoard()
    {
        return $this->board;
    }

    public function move(PlayerCoordinates $coordinates)
    {
        $gridCell = $this->board[$coordinates->getY()][$coordinates->getX()];

        if ($gridCell) {
            throw new Exception('The peice is already taken.');
        }

        if (!is_null($this->currentPlayer) && $coordinates->getPlayer() !== $this->currentPlayer)
        {
            throw new Exception('Piece is being placed out of turn.');
        }

        $this->board[$coordinates->getY()][$coordinates->getX()] = $coordinates->getPlayer()->name;
        $this->updateCurrentPlayer($coordinates->getPlayer());
    }

    private function updateCurrentPlayer(Player $player)
    {
        if (is_null($this->currentPlayer)) {
            $this->currentPlayer = $player;
        }

        $this->currentPlayer = ($player === Player::X)
            ? Player::Y
            : Player::X;
    }

    protected function checkWinner()
    {
        // define winner
    }
}