@extends('default.layouts')
@section('title', '- Tarefas')
@section('content')
    <h1 class="text-white">Tarefa</h1>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('store.task') }}" method="post">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Título</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
                    @error('title')
                        <span style="color: red">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrição</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ old('description') }}</textarea>
                    @error('description')
                        <span style="color: red">
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <button class="btn btn-secondary">Salvar</button>
            </form>
        </div>
    </div>

@endsection
