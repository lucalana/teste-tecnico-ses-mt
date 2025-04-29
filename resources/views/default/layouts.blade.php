<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tarefa @yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('style/index.css') }}">
</head>

<body class="bg-secondary">
    @auth
        @include('default.navbar')
    @endauth
    <div class="container position-relative">
        @session('message')
            <div class="position-relative">
                <div class="position-absolute top-0 end-0">
                    <div class="toast align-items-center fade show" role="alert" data-bs-autohide="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                {{ $value }}
                            </div>
                            <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast"
                                aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                const toastElList = document.querySelectorAll('.toast');
                [...toastElList].map(toastEl => setTimeout(() => toastEl.remove(), 3000));
            </script>
        @endsession
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>
