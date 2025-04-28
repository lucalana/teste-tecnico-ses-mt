@extends('default.layouts')
@section('title', '- Cadastro')
@section('content')
    <div class="d-flex flex-row justify-content-center align-items-center vh-100">
        <div class="card w-50">
            <div class="card-header">
                <h2>Acessar conta</h2>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        @error('email')
                            <span style="color: red">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="password" name="password">
                        @error('password')
                            <span style="color: red">
                                {{ $message }}
                            </span>
                        @enderror
                    </div>
                    <button class="btn btn-secondary">Entrar</button>
                </form>
            </div>
        </div>
    </div>
@endsection
