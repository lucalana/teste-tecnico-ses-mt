<?php

use App\Models\Task;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('should return 200', function () {
    $user = User::factory()->create();
    actingAs($user);

    get(route('home'))->assertOk();
});

it('should redirect to login', function () {
    $request = get(route('home'));
    $request->assertRedirect(route('login'));
});

it('should use the view task.index', function () {
    $user = User::factory()->create();
    actingAs($user);

    get(route('home'))->assertViewIs('task.index');
});

it('should always bring the auth user task', function () {
    $users = User::factory()->create();
    $authUser = User::factory()->create();
    Task::factory(150)->recycle($users)->create();
    Task::factory(30)->recycle($authUser)->create();
    actingAs($authUser);

    expect(Task::query()->get())->toHaveCount(30);
});

it('should list all tasks', function () {
    $user = User::factory()->create();
    Task::factory(30)->recycle($user)->create();
    actingAs($user);
    $tasks = collect(Task::query()->status('')->orderByDesc('id')->paginate()->items())
        ->map(fn($task) => $task->title)
        ->toArray();
    get(route('home'))->assertOk()->assertSeeTextInOrder($tasks);
});

it('should list only completed tasks', function () {
    $user = User::factory()->create();
    Task::factory(30)->recycle($user)->create();
    actingAs($user);
    $tasks = collect(Task::query()->status('Concluída')->orderByDesc('id')->paginate()->items())
        ->map(fn($task) => $task->title)
        ->toArray();
    get(route('home', ['status' => 'Concluída']))->assertOk()->assertSeeTextInOrder($tasks);
});

it('should list only pending tasks', function () {
    $user = User::factory()->create();
    Task::factory(30)->recycle($user)->create();
    actingAs($user);
    $tasks = collect(Task::query()->status('Pendente')->orderByDesc('id')->paginate()->items())
        ->map(fn($task) => $task->title)
        ->toArray();
    get(route('home', ['status' => 'Pendente']))->assertOk()->assertSeeTextInOrder($tasks);
});

