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

    public function toggleStatus(Task $task)
    {
        $task->status = $task->status == 'Concluído' ? 'Pendente' : 'Concluído';
        $task->save();

        return redirect()->back();
    }
}
