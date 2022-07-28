<?php

namespace App\Services\TicTacToe;

use App\Enums\GameState;
use App\Enums\Player;
use App\Services\TicTacToe\PlayerCoordinates;
use Exception;

class TicTacToeGame
{
    private array $board;

    private GameState $state = GameState::Active;

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

    public function getBoard()
    {
        return $this->board;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getCurrentPlayer()
    {
        return $this->state === GameState::Active
            ? $this->currentPlayer->value ?? Player::X->value.' | '.Player::O->value
            : '';
    }

    public function move(PlayerCoordinates $coordinates)
    {
        if ($this->state !== GameState::Active) {
            throw new Exception("The game is over.");
        }

        $boardCell = $this->board[$coordinates->getY()][$coordinates->getX()];

        if ($boardCell) {
            throw new Exception('The piece is already taken.', 409);
        }

        if (!is_null($this->currentPlayer) && $coordinates->getPlayer() !== $this->currentPlayer)
        {
            throw new Exception('Piece is being placed out of turn.', 406);
        }

        $this->board[$coordinates->getY()][$coordinates->getX()] = $coordinates->getPlayer()->value;

        $this->updateGameState();

        $this->updateCurrentPlayer($coordinates->getPlayer());
    }

    private function updateCurrentPlayer(Player $player)
    {
        if (is_null($this->currentPlayer)) {
            $this->currentPlayer = $player;
        }

        $this->currentPlayer = ($player === Player::X)
            ? Player::O
            : Player::X;
    }

    public function getRemainingMoves()
    {
        $flattenBoard = array_merge(...$this->board);

        return (count($flattenBoard) - count(array_filter($flattenBoard)));
    }

    private function updateGameState()
    {
        if ($this->isWinningMove()) {
            $this->state = ($this->currentPlayer === Player::X)
                ? GameState::WonX
                : GameState::WonO;
        } elseif (!$this->getRemainingMoves()) {
            $this->state = GameState::Draw;
        }
    }

    private function isWinningMove()
    {
        return ($this->hasHorizontalWin() ||
                $this->hasVerticallWin() ||
                $this->hasDiagonalWin());
    }

    private function hasHorizontalWin()
    {
        for ($i=0; $i<3; $i++) {
            $winner = $this->board[$i][0];

            for ($j=0; $j<3; $j++) {
                if ($this->board[$i][$j] != $winner) {
                    $winner = null;
                    break;
                }
            }

            if ($winner !== null) {
                break;
            }
        }

        return boolval($winner);
    }

    private function hasVerticallWin()
    {
        for ($i=0; $i<3; $i++) {
            $winner = $this->board[0][$i];

            for ($j=0; $j<3; $j++) {
                if ($this->board[$j][$i] != $winner) {
                    $winner = null;
                    break;
                }
            }

            if ($winner !== null) {
                break;
            }
        }
        return boolval($winner);
    }

    private function hasDiagonalWin()
    {
        $winner = $this->board[0][0];
        for ($i=0; $i<3; $i++) {
            if ($this->board[$i][$i] != $winner) {
                $winner = null;
                break;
            }
        }

        if ($winner === null) {
            $winner = $this->board[0][2];
            for ($i=0; $i<3; $i++) {
                if ($this->board[$i][2-$i] != $winner) {
                    $winner = null;
                    break;
                }
            }
        }

        return boolval($winner);
    }
}