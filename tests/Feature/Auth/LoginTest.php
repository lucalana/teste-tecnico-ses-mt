<?php

use App\Models\User;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertAuthenticatedAs;
use function Pest\Laravel\assertGuest;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('should return status 200', function () {
    get(route('login.form'))->assertOk();
});

it('should use the view register', function () {
    get(route('login.form'))->assertViewIs('auth.login');
});

it('should login the user', function () {
    $user = User::factory()->create();

    $request = post(route('login'), [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $request->assertRedirect(route('home'));
    assertAuthenticated();
    assertAuthenticatedAs($user);
});

it('should not login the user', function () {

    $request = post(route('login'), [
        'email' => 'email@errado.com',
        'password' => 'password',
    ]);

    $request->assertInvalid(['password' => 'Email ou senha incorretos.']);
    assertGuest();
});

it('should validate the user', function ($data, $error) {
    $request = post(route('login'), $data);

    $request->assertInvalid($error);
})->with([
            'password.required' => [
                ['email' => 'email@gmail.com', 'password' => ''],
                ['password' => 'O campo senha é obrigatório.']
            ],
            'email.required' => [
                ['email' => '', 'password' => '12312412asd'],
                ['email' => 'O campo email é obrigatório.']
            ],
            'email.valid' => [
                ['email' => 'asdasdagameoil.com', 'password' => '12312412asd'],
                ['email' => 'O campo email deve ser um endereço de e-mail válido.']
            ]
        ]);
