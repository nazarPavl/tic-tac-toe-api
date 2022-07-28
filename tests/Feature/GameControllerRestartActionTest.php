<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameControllerRestartActionTest extends TestCase
{
    public function init()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_restart_empty_active_game()
    {
        $response = $this->post('/restart');

        $response->assertStatus(406);
        $response->assertSee('Not acceptable.');
    }

    public function test_restart_with_existing_game()
    {
        $this->init();

        $response = $this->post('/restart');

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
}
