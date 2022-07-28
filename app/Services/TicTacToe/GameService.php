<?php

namespace App\Services\TicTacToe;

use App\Enums\GameState;
use App\Enums\Player;
use App\Models\Game;
use App\Repositories\Contracts\GameMoveRepositoryInterface;
use App\Repositories\Contracts\GameRepositoryInterface;
use App\Services\TicTacToe\Contracts\GameService as GameServiceContract;
use App\Services\TicTacToe\PlayerCoordinates;
use App\Services\TicTacToe\TicTacToeGame;
use Exception;

class GameService implements GameServiceContract
{   
    public function __construct(
        private GameRepositoryInterface $gameRepository,
        private GameMoveRepositoryInterface $gameMoveRepository,
        private TicTacToeGame $ticTacToe
    )
    {
        
    }

    public function initializeGame()
    {
        $latestGame = $this->gameRepository->getLatestGame();

        if (!$latestGame) {
            return $this->gameRepository->createNewGame();
        }
    }

    public function activeGame()
    {
        $activeGame = $this->gameRepository->getActiveGame();

        if (!$activeGame) {
            throw new Exception("There is no active game.");
        }

        return $activeGame;
    }

    public function buildTicTacToeGame(Game $game)
    {
        $ticTacToe = new TicTacToeGame();

        foreach ($game->moves as $move) {
            $playerCoordinates = new PlayerCoordinates($move->x, $move->y, $move->player);

            $ticTacToe->move($playerCoordinates);
        }

        return $ticTacToe;
    }

    public function makeMove(string $player, int $x, int $y)
    {
        $player = Player::tryFrom($player);

        if (is_null($player)) {
            throw new Exception("Invalid player value.");
        }

        $activeGame = $this->activeGame();

        $ticTacToe = $this->buildTicTacToeGame($activeGame);

        $playerCoordinates = new PlayerCoordinates($x, $y, $player);

        $ticTacToe->move($playerCoordinates);

        $this->gameMoveRepository
            ->createNewMove($activeGame->id, $player, $playerCoordinates->getX(), $playerCoordinates->getY());

        if ($activeGame->state !== $ticTacToe->getState()) {
            $this->gameRepository->updateGameStatus($activeGame->id, $ticTacToe->getState());
        }
    }

    public function state()
    {   
        $game = $this->buildTicTacToeGame($this->activeGame());

        return [
            'board' => $game->getBoard(),
            'score' => [
                Player::X->value => $this->gameRepository->getScoreForState(GameState::WonX),
                Player::O->value => $this->gameRepository->getScoreForState(GameState::WonO)
            ],
            'currentTurn' => $game->getCurrentPlayer(),
            'victory' => $game->getState()
        ];
    }

    public function restart()
    {
        $activeGame = $this->activeGame();

        if ($activeGame->state === GameState::Active) {
            $this->gameRepository->updateGameStatus($activeGame->id, GameState::Draw);
        }

        $this->gameRepository->createNewGame();
    }

    public function delete()
    {
        $this->gameRepository->truncateGames();
    }
}