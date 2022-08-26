<?php

namespace Tests\Feature;


use Tests\TestCase;

class LogTest extends TestCase
{
    public function test_api_is_available()
    {

        $this->json('get', '/api/count', [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure(["counter"]);
    }
}
