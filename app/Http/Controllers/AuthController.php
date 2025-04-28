<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        if (!Auth::attempt($request->validated())) {
            return to_route('login.form')->withInput()
                ->withErrors(['password' => 'Email ou senha incorretos.']);
        }

        return to_route('home');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return to_route('login.form');
    }

    public function registerForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = User::query()->create($request->validated());

        Auth::login($user);

        return to_route('home');
    }
}
