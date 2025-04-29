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
        $task->status = $task->status == 'Concluída' ? 'Pendente' : 'Concluída';
        $task->save();
        return redirect()->back()
            ->with('message', 'Tarefa "' . $task->title . '" marcada como ' . strtolower($task->status) . '.');
    }

    public function deleteTask(Task $task)
    {
        $task->delete();

        return redirect()->back()->with('message', 'Tarefa "' . $task->title . '" apagada.');
    }
}
