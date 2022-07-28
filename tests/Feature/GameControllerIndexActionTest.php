<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class GameControllerIndexActionTest extends TestCase
{
    use RefreshDatabase;

    public function test_the_action_returns_valid_json()
    {
        $response = $this->getJson('/');

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
