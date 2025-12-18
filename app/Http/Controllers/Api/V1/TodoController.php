<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Action\CreateTodoAction;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Http\Requests\StoreTodoRequest;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todos = Todo::all();
        return TodoResource::collection($todos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTodoRequest $request, CreateTodoAction $createTodoAction): JsonResponse
    {
        $data = $request->validated();
        $todo = $createTodoAction->execute($data);

        return (new TodoResource($todo))
            ->response()
            ->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
