<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laboratorio Security')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#15803d;">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">V2 - Hardened</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navV2">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navV2">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/login">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="/register">Registro</a></li>
                <li class="nav-item"><a class="nav-link" href="/dashboard">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="/comments">Comentarios</a></li>
                <li class="nav-item"><a class="nav-link" href="/files">Archivos</a></li>
                <li class="nav-item"><a class="nav-link" href="/network/ping">Red</a></li>
            </ul>
        </div>
    </div>
</nav>

<main class="container py-5">
    @yield('content')
</main>

<footer class="border-top py-4 mt-5 bg-white">
    <div class="container text-center text-muted">
        <strong>VERSIÓN 2 - HARDENED</strong>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
