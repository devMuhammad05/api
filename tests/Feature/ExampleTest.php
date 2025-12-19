<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_the_application_is_up_and_running(): void
    {
        $response = $this->get('/up');

        $response->assertStatus(200);
    }
}
