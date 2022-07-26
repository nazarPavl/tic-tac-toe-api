<?php


use App\Http\Controllers\API\GameController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::controller(GameController::class)->group(function() {
    Route::get('/', 'index');
    Route::delete('/', 'delete');
    Route::post('/restart', 'restart');
    Route::post('/{player}', 'move');
});