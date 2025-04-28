<nav class="navbar bg-body-tertiary mb-5 d-flex flex-row px-5">
    <div>
        <span class="navbar-text">
            Seja bem vindo, {{ auth()->user()->name }}!
        </span>
    </div>
    <div>
        <form action="{{ route('logout') }}" method="post">
            @csrf
            <button class="btn btn-secondary">Sair</button>
        </form>
    </div>
</nav>
