<?php

namespace App\Action;

use App\Models\Todo;
use Illuminate\Http\Request;

class CreateTodoAction
{

    /**
     * @param array $data
     * @return Todo
     */

    public function execute(array $data): Todo
    {
        return Todo::create($data);
    }
}
