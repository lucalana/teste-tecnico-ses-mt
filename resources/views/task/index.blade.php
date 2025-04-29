@extends('default.layouts')
@section('title', '- Tarefas')
@section('content')
    <h1 class="text-white">Tarefas</h1>
    <div class="my-5">
        <div class="py-3 d-flex flex-row justify-content-between">
            <div>
                <a href="{{ route('home') }}" class="text-decoration-none">
                    <span class="badge text-bg-dark badge-dark">Todas</span>
                </a>
                <a href="{{ route('home', ['status' => 'Concluída']) }}" class="text-decoration-none">
                    <span class="badge text-bg-success badge-success">Concluidas</span>
                </a>
                <a href="{{ route('home', ['status' => 'Pendente']) }}" class="text-decoration-none">
                    <span class="badge text-bg-light badge-light">Pendentes</span>
                </a>
            </div>
            <div>
                <a class="btn btn-secondary border" href="{{ route('create.task') }}">Criar Tarefa</a>
            </div>
        </div>
        <div class="accordion" id="accordionPanelsStayOpenExample">
            @foreach ($tasks as $task)
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#panelsStayOpen-collapse{{ $task->id }}"
                            aria-controls="panelsStayOpen-collapse{{ $task->id }}">
                            <span class="pe-3">
                                <strong>{{ $task->title }} </strong>
                            </span>
                            <a href="{{ route('toggle.status', $task->id) }}">
                                @if ($task->status == 'Pendente')
                                    <span class="badge text-bg-secondary">{{ $task->status }}</span>
                                @else
                                    <span class="badge text-bg-success">{{ $task->status }}</span>
                                @endif
                            </a>
                        </button>
                    </h2>
                    <div id="panelsStayOpen-collapse{{ $task->id }}" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <div class="d-flex flex-column">
                                <span class="fs-5">
                                    {{ $task->description }}
                                </span>
                                <span class="d-flex justify-content-between pt-5">
                                    <div class="d-flex flex-row gap-2">
                                        <a href="{{ route('edit.task', $task->id) }}"
                                            class="btn btn-secondary btn-sm">Editar</a>
                                        <form action="{{ route('delete.task', $task->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button class="btn btn-danger btn-sm">Deletar</button>
                                        </form>
                                    </div>
                                    <span class="fs-6 fw-lighter">
                                        Criado em: {{ $task->created_at->format('d/m/Y') }}
                                    </span>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="accordion-item">
                <div class="accordion-header pt-3 px-3">
                    {{ $tasks->appends([
                            'status' => request()->get('status'),
                        ])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
