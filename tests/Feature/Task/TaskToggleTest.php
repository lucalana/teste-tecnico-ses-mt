<?php

use App\Models\Task;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('should change the task status', function () {
    $user = User::factory()->create();
    $task = Task::factory(['status' => 'Pendente'])->recycle($user)->create();

    actingAs($user);
    get(route('toggle.status', $task->id))->assertRedirect();

    expect($task)->refresh()->status->toBe('Concluída');
});

it('should not found the page', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create();

    actingAs($user);
    get(route('toggle.status', $task->id))->assertNotFound();
});
