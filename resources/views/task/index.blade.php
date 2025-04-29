@extends('default.layouts')
@section('title', '- Tarefas')
@section('content')
    <h1 class="text-white">Tarefas</h1>
    <div class="my-5">
        <div class="py-3">
            <a href="{{ route('home') }}">
                <span class="badge text-bg-dark badge-dark">Todas</span>
            </a>
            <a href="{{ route('home', ['status' => 'Concluído']) }}">
                <span class="badge text-bg-success badge-success">Concluidas</span>
            </a>
            <a href="{{ route('home', ['status' => 'Pendente']) }}">
                <span class="badge text-bg-secondary border badge-secondary">Pendentes</span>
            </a>
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
                            <div class="d-flex flex-column gap-2">
                                <span class="fs-5">
                                    {{ $task->description }}
                                </span>
                                <span class="fs-6 fw-lighter text-end">
                                    Criado em: {{ $task->created_at->format('d/m/Y') }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="accordion-item">
                <div class="accordion-header pt-3">
                    {{ $tasks->appends([
                            'status' => request()->get('status'),
                        ])->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
