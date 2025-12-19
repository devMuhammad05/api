<?php

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


test("it returns paginated todos", function () {
    Todo::factory(30)->create();

    $response = $this->getJson('api/v1/todos');

    $response->assertStatus(200)
        ->assertJsonCount(20, 'data')
        ->assertJsonPath('meta.current_page', 1)
        ->assertJsonPath('meta.total', 30)
        ->assertJsonPath('meta.per_page', 20);
});

test("can create todo", function() {
    $data = [
        'title' => "Todo title",
        'description' => "Todo description",
    ];

    $response = $this->postJson('api/v1/todos', $data);

    $response->assertStatus(201);
});
