<?php

namespace App\Services\TicTacToe;

use App\Enums\Player;
use App\Exceptions\NotAcceptable;

class PlayerCoordinates
{
    private int $x;

    private int $y;

    public function __construct(
        int $x,
        int $y,
        private Player $player
    )
    {
        if (!$this->coordinateIsValid($x) || !$this->coordinateIsValid($y)) {
            throw new NotAcceptable();
        }

        $this->x = $x;
        $this->y = $y;
    }

    private function coordinateIsValid(int $coordinate)
    {
        if ($coordinate >= 0 && $coordinate <= 2) {
            return true;
        }

        return false;
    }

    public function getX()
    {
        return $this->x;
    }

    public function getY()
    {
        return $this->y;
    }

    public function getPlayer()
    {
        return $this->player;
    }
}