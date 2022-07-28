<?php

namespace App\Http\Controllers\API;

use App\Enums\Player;
use App\Http\Controllers\Controller;
use App\Http\Requests\MoveRequest;
use App\Services\TicTacToe\Contracts\GameService;

class GameController extends Controller
{
    public function index(GameService $gameService)
    {
        $gameService->initializeGame();

        return response()->json($gameService->state());
    }

    public function move(MoveRequest $request, GameService $gameService, string $player)
    {
        $validated = $request->validated();

        $gameService->makeMove($player, $validated[Player::X->value], $validated[Player::O->value]);

        return response()->json($gameService->state());
    }

    public function restart(GameService $gameService)
    {
        $gameService->restart();

        return response()->json($gameService->state());
    }

    public function delete(GameService $gameService)
    {
        $gameService->delete();

        return response()->json([
            'currentTurn' => Player::X->value.' | '.Player::O->value
        ]);
    }
}