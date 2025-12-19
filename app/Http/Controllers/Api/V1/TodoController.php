<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Action\CreateTodoAction;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\TodoResource;
use App\Http\Requests\StoreTodoRequest;
use App\Http\Requests\UpdateTodoRequest;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $todos = Todo::paginate(20);
        return TodoResource::collection($todos)
        ->response()
        ->setStatusCode(200);
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
    public function show(Todo $todo)
    {
        return (new TodoResource($todo))
            ->response()
            ->setStatusCode(200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTodoRequest $request, Todo $todo): JsonResponse
    {
        $data = $request->validated();
        $todo->update($data);

        return (new TodoResource($todo))
                ->response()
                ->setStatusCode(200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Todo $todo): JsonResponse
    {
        $todo->delete();

        return response()->json([], 204);
    }
}
