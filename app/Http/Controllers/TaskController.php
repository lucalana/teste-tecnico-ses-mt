<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;

class TaskController extends Controller
{
    public function index()
    {
        return view('task.index', [
            'tasks' => Task::query()->status(request()->get('status', ''))->orderByDesc('id')->paginate(),
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

    public function edit(Task $task)
    {
        return view('task.edit', ['task' => $task]);
    }

    public function update(Task $task, UpdateTaskRequest $request)
    {
        $task->update($request->validated());

        return to_route('home', ['status' => $task->status])
            ->with('message', 'Tarefa "' . $task->title . '" alterada.');
    }

    public function create()
    {
        return view('task.create');
    }

    public function store(StoreTaskRequest $request)
    {
        Task::query()->create([
            ...$request->validated(),
            'status' => 'Pendente',
            'user_id' => auth()->id(),
        ]);

        return to_route('home', ['status' => 'Pendente'])
            ->with('message', 'Tarefa "' . $request->get('title') . '" criada.');
    }
}
