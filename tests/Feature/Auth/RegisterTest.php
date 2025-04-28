<?php

use App\Models\User;
use function Pest\Laravel\assertAuthenticated;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\get;
use function Pest\Laravel\post;

it('should return status 200', function () {
    get(route('register.form'))->assertOk();
});

it('should use the view register', function () {
    get(route('register.form'))->assertViewIs('auth.register');
});

it('should create and authenticate an user', function () {
    $request = post(route('register'), [
        'name' => 'luca',
        'email' => 'email@gmail.com',
        'password' => '12345678pass'
    ]);

    $request->assertRedirect(route('home'));
    assertAuthenticated();
    assertDatabaseCount('users', 1);
});

it('should validate the user data', function ($data, $error) {
    if ($data['email'] === 'unico') {
        $user = User::factory()->create();
        $data['email'] = $user->email;
    }
    $request = post(route('register'), $data);

    $request->assertInvalid($error);
})->with([
            'password.required' => [
                ['name' => 'nome', 'email' => 'email@gmail.com', 'password' => ''],
                ['password' => 'O campo senha é obrigatório.']
            ],
            'password.max' => [
                ['name' => 'nome', 'email' => 'email@gmail.com', 'password' => str_repeat('*', 200)],
                ['password' => 'O campo senha não pode ser superior a 20 caracteres.']
            ],
            'password.min' => [
                ['name' => 'nome', 'email' => 'email@gmail.com', 'password' => '123'],
                ['password' => 'O campo senha deve ter pelo menos 8 caracteres.']
            ],
            'name.max' => [
                ['name' => str_repeat('*', 202), 'email' => 'email@gmail.com', 'password' => '12312412asd'],
                ['name' => 'O campo nome não pode ser superior a 200 caracteres.']
            ],
            'name.min' => [
                ['name' => 'as', 'email' => 'email@gmail.com', 'password' => '12312412asd'],
                ['name' => 'O campo nome deve ter pelo menos 3 caracteres.']
            ],
            'name.required' => [
                ['name' => '', 'email' => 'email@gmail.com', 'password' => '12312412asd'],
                ['name' => 'O campo nome é obrigatório.']
            ],
            'email.required' => [
                ['name' => 'jose', 'email' => '', 'password' => '12312412asd'],
                ['email' => 'O campo email é obrigatório.']
            ],
            'email.valid' => [
                ['name' => 'jose', 'email' => 'asdasdagameoil.com', 'password' => '12312412asd'],
                ['email' => 'O campo email deve ser um endereço de e-mail válido.']
            ],
            'email.unique' => [
                ['name' => 'jose', 'email' => 'unico', 'password' => '12312412asd'],
                ['email' => 'O campo email já está sendo utilizado.']
            ]
        ]);
