<?php

use App\Models\User;
use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\post;

it('should logout an user', function () {
    $user = User::factory()->create();
    actingAs($user);

    $request = post(route('logout'));

    assertGuest();
    $request->assertRedirect(route('register.form'));
});
