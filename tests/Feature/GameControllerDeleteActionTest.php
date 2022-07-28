<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class GameControllerDeleteActionTest extends TestCase
{
    public function init()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_delete_empty_games()
    {
        $response = $this->delete('/');

        $response->assertStatus(200);

        $response->assertJson([
            'currentTurn' => 'x | o'
        ]);
    }

    public function test_delete_existing_games()
    {
        $this->init();

        $response = $this->postJson('/x', [
            'x' => 0,
            'y' => 1
        ]);

        $response->assertStatus(200);

        $response = $this->postJson('/o', [
            'x' => 1,
            'y' => 1
        ]);

        $response->assertStatus(200);

        $this->test_delete_empty_games();
    }
}
