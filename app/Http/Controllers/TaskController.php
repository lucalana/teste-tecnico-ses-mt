<?php

namespace App\Http\Controllers;

use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        return view('task.index', [
            'tasks' => Task::query()->status(request()->get('status', ''))->paginate(),
        ]);
    }
}
