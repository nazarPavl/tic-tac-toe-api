<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameControllerMoveActionTest extends TestCase
{
    use RefreshDatabase;

    public function init()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_the_active_game_does_not_exists()
    {
        $response = $this->postJson('/o', [
            'x' => 0,
            'y' => 0
        ]);

        $response->assertStatus(406);
        $response->assertSee('Not acceptable.');
    }

    public function test_the_player_is_invalid()
    {
        $this->init();

        $response = $this->postJson('/y', [
            'x' => 0,
            'y' => 0
        ]);

        $response->assertStatus(406);
        $response->assertSee('Not acceptable.');
    }

    public function test_the_move_is_saved()
    {
        $this->init();

        $response = $this->postJson('/x', [
            'x' => 0,
            'y' => 0
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'board' => [],
            'score' => [
                'x',
                'o'
            ],
            'currentTurn',
            'victory'
        ]);
    }

    public function test_the_move_is_already_taken()
    {
        $this->init();

        $response = $this->postJson('/x', [
            'x' => 0,
            'y' => 0
        ]);

        $response->assertStatus(200);

        $response = $this->postJson('/o', [
            'x' => 0,
            'y' => 0
        ]);

        $response->assertStatus(409);
        $response->assertSee('Conflict.');
    }

    public function test_move_with_wrong_x_coordinate()
    {
        $this->init();

        $response = $this->postJson('/x', [
            'x' => 3,
            'y' => 0
        ]);

        $response->assertStatus(406);
        $response->assertSee('Not acceptable.');
    }

    public function test_move_with_wrong_y_coordinate()
    {
        $this->init();

        $response = $this->postJson('/x', [
            'x' => 0,
            'y' => 3
        ]);

        $response->assertStatus(406);
        $response->assertSee('Not acceptable.');
    }

    public function test_the_move_is_out_of_turn()
    {
        $this->init();

        $response = $this->postJson('/x', [
            'x' => 0,
            'y' => 0
        ]);

        $response->assertStatus(200);

        $response = $this->postJson('/x', [
            'x' => 0,
            'y' => 1
        ]);

        $response->assertStatus(406);
        $response->assertSee('Not acceptable.');
    }
}
