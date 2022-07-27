<?php

namespace App\Providers;

use App\Repositories\Contracts\GameMoveRepositoryInterface;
use App\Repositories\Contracts\GameRepositoryInterface;
use App\Repositories\GameMoveRepository;
use App\Repositories\GameRepository;
use App\Services\TicTacToe\Contracts\GameService;
use App\Services\TicTacToe\GameService as TicTacToeGameService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * All of the container bindings that should be registered.
     *
     * @var array
     */
    public $bindings = [
        GameService::class => TicTacToeGameService::class,
        GameRepositoryInterface::class => GameRepository::class,
        GameMoveRepositoryInterface::class => GameMoveRepository::class,
        GameMoveRepository::class => GameMoveRepository::class,
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
