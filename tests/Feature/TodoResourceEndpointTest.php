<?php

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


test("it returns paginated todos", function () {
    $todo = Todo::factory(30)->create();

    $response = $this->getJson('api/v1/todos');

    $response->assertStatus(200)
        ->assertJsonCount(20, 'data')
        ->assertJsonPath('meta.current_page', 1)
        ->assertJsonPath('meta.total', 30)
        ->assertJsonPath('meta.per_page', 20);
});


test("can create todo", function () {
    $data = [
        'title' => "Todo title",
        'description' => "Todo description",
    ];

    $response = $this->postJson('api/v1/todos', $data);

    $data = $response->json('data');

    $response->assertStatus(201);

    expect($data['title'])->toBe("Todo title");
});


test("return specific todo based on id", function () {

    $todo1 = Todo::factory()->create([
        'title' => "Todo title",
        'description' => "Todo description",
    ]);

    $todo2 = Todo::factory()->create([
        'title' => "Todo title 2",
        'description' => "Todo description 2",
    ]);

    $response = $this->getJson("api/v1/todos/{$todo2['id']}");
    $data = $response->json('data');

    $response->assertStatus(200);

    expect($data['title'])->toBe("Todo title 2");
    expect($data['description'])->toBe("Todo description 2");
});


test("can update todo", function() {

    $todo = Todo::factory()->create();

    $updatedData = [
        'title' => "Todo title",
        'description' => "Todo description",
    ];

    $response = $this->putJson("api/v1/todos/{$todo->id}", $updatedData);
    $responseData = $response->json('data');

    $response->assertStatus(200)
    ->assertJson([
        'data' => $updatedData
    ]);

    $this->assertDatabaseHas('todos', [
        'id' => $todo->id,
        'title' => "Todo title",
        'description' => "Todo description",
    ]);

});
