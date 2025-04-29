<?php

use App\Models\Task;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;
use function Pest\Laravel\put;

it('should return status 200', function () {
    $user = User::factory()->create();
    $task = Task::factory()->recycle($user)->create();
    actingAs($user);

    get(route('edit.task', $task->id))->assertOk();
});

it('should use the edit view and the correct information', function () {
    $user = User::factory()->create();
    $task = Task::factory()->recycle($user)->create();
    actingAs($user);

    $request = get(route('edit.task', $task->id));
    $request->assertOk()
        ->assertViewIs('task.edit')
        ->assertViewHas('task', $task)
        ->assertSeeHtmlInOrder([
            $task->title,
            $task->description
        ]);
});

it('should return not found for wrong task in edit page', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create();
    actingAs($user);

    get(route('edit.task', $task->id))->assertNotFound();
});

it('should return not found for wrong task in update', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create();
    actingAs($user);

    put(route('edit.task', $task->id), [
        'title' => 'Teste',
        'description' => 'Teste teste teste'
    ])->assertNotFound();
});

it('should update the task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->recycle($user)->create();
    actingAs($user);
    put(route('update.task', $task->id), ['title' => 'Alterado!', 'description' => 'Nova descrição!'])
        ->assertRedirect();

    expect($task)->refresh()->title->toBe('Alterado!')->description->toBe('Nova descrição!');
});


it('should return validation erros', function ($data, $error) {
    $user = User::factory()->create();
    $task = Task::factory()->recycle($user)->create();
    actingAs($user);

    $request = put(route('update.task', $task->id), $data);
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
