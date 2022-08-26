<?php

namespace Tests\Feature;


use App\Models\Log;
use Tests\TestCase;

class LogTest extends TestCase
{
    public function test_api_is_available()
    {

        $this->json('get', '/api/count', [], ['Accept' => 'application/json'])
            ->assertStatus(200)
            ->assertJsonStructure(["counter"]);
    }

    public function test_api_fail_if_services_names_doesnt_pass_as_array()
    {
        $this->json('get', '/api/count', ['serviceNames' => 'USER-SERVICE'], ['Accept' => 'application/json'])
            ->assertStatus(422);
    }


}
