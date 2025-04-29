<?php

use App\Models\Task;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('should return status 200', function () {
    $user = User::factory()->create();
    actingAs($user);

    get(route('create.task'))->assertOk();
});

it('should use create view', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = get(route('create.task'));

    $request->assertViewIs('task.create');
});

it('should redirect to login', function () {
    get(route('create.task'))->assertRedirect(route('login.form'));
});

it('should save a task in the database', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('store.task'), ['title' => 'Título 1', 'description' => 'Descrição da tarefa']);

    $request->assertRedirect(route('home', ['status' => 'Pendente']))->assertSessionHas('message');
    assertDatabaseCount('tasks', 1);
    assertDatabaseHas('tasks', [
        'title' => 'Título 1',
        'user_id' => $user->id,
    ]);
});


it('should return validation erros', function ($data, $error) {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('store.task'), $data);
    $request->assertInvalid($error);
})->with([
            'title.required' => [
                ['title' => '', 'description' => str_repeat('*', 100)],
                ['title' => 'O campo título é obrigatório.']
            ],
            'title.max' => [
                ['title' => str_repeat('*', 201), 'description' => str_repeat('*', 100)],
                ['title' => 'O campo título não pode ser superior a 200 caracteres.']
            ],
            'description.required' => [
                ['title' => str_repeat(' * ', 100), 'description' => ''],
                ['description' => 'O campo descrição é obrigatório.']
            ],
        ]);
