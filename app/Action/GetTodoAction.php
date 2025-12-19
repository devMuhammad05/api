<?php

namespace App\Action;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;


class GetTodoAction
{

    /**
     * Execute the action to get todos
     * @param Request $request
     * @return LengthAwarePaginator
     */

    public function execute(Request $request): LengthAwarePaginator
    {
        return Todo::query()
            ->when($request->filled("status"), function ($query) use ($request) {
                $query->where('status', $request->string('status'));
            })
            ->latest()
            ->paginate($request->integer('per_page', 20));
    }
}
