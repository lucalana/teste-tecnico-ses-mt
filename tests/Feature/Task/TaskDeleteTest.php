<?php

use App\Models\Task;
use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseEmpty;
use function Pest\Laravel\delete;

it('should delete the task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->recycle($user)->create();

    actingAs($user);
    delete(route('delete.task', $task->id))->assertRedirect();

    assertDatabaseEmpty('tasks');
});

it('should not found the page', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create();

    actingAs($user);
    delete(route('delete.task', $task->id))->assertNotFound();
});
