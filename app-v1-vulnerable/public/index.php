<?php
session_start();

function renderPage(string $title, string $content, string $theme = 'danger'): void
{
    $accent = $theme === 'danger' ? '#b91c1c' : '#15803d';
    $btn = $theme === 'danger' ? 'btn-danger' : 'btn-success';
    $outline = $theme === 'danger' ? 'btn-outline-danger' : 'btn-outline-success';
    $brand = $theme === 'danger' ? 'V1 - Vulnerable' : 'V2 - Hardened';

    echo <<<HTML
<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>$title</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:$accent;">
    <div class="container">
        <a class="navbar-brand fw-bold" href="/">$brand</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navLab">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navLab">
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
$content
</main>
<footer class="border-top py-4 mt-5 bg-white">
    <div class="container text-center text-muted">
        <strong>VERSIÓN 1 - VULNERABLE (fines educativos)</strong>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
HTML;
}

$path = parse_url($_SERVER['REQUEST_URI'] ?? '/', PHP_URL_PATH) ?: '/';
$path = '/' . trim($path, '/');
if ($path === '') {
    $path = '/';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $path === '/login') {
    $email = htmlspecialchars($_POST['email'] ?? '');
    $password = htmlspecialchars($_POST['password'] ?? '');
    $message = $email && $password ? 'Inicio de sesión simulado para ' . $email . ' usando credenciales débiles.' : 'Ingresa tus credenciales para continuar.';
    $content = <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-sm border-danger">
            <div class="card-body p-4">
                <h1 class="h3 text-danger">Login</h1>
                <p class="text-muted">$message</p>
                <div class="alert alert-warning">Este laboratorio muestra una autenticación insegura y form-data sin validación de entrada.</div>
                <a href="/dashboard" class="btn btn-danger">Ir al dashboard</a>
            </div>
        </div>
    </div>
</div>
HTML;
    renderPage('Login - V1', $content, 'danger');
    exit;
}

switch ($path) {
    case '/':
        $content = <<<HTML
<div class="row align-items-center g-4">
    <div class="col-lg-7">
        <h1 class="display-5 fw-bold text-danger">Laboratorio de Seguridad Informática</h1>
        <p class="lead text-muted">Aplicación vulnerable para evaluar vulnerabilidades OWASP en un entorno controlado.</p>
        <div class="d-flex gap-2 flex-wrap">
            <a href="/login" class="btn btn-danger">Ir al login</a>
            <a href="/dashboard" class="btn btn-outline-danger">Ver dashboard</a>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card shadow-sm border-danger">
            <div class="card-body">
                <h5 class="card-title">Módulos disponibles</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="/comments">Comentarios</a></li>
                    <li class="list-group-item"><a href="/profile/1">Perfil</a></li>
                    <li class="list-group-item"><a href="/files">Subida de archivos</a></li>
                    <li class="list-group-item"><a href="/network/ping">Herramienta de red</a></li>
                </ul>
                <div class="alert alert-danger mt-3 mb-0">Modo laboratorio activo: se usan datos de ejemplo y vulnerabilidades intencionales.</div>
            </div>
        </div>
    </div>
</div>
HTML;
        break;

    case '/login':
        $content = <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm border-danger">
            <div class="card-body p-4">
                <h1 class="h3 text-danger">Iniciar sesión</h1>
                <form method="post" action="/login">
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input name="email" class="form-control" value="demo@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input name="password" type="password" class="form-control" value="password123">
                    </div>
                    <button class="btn btn-danger">Entrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
HTML;
        break;

    case '/register':
        $content = <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm border-danger">
            <div class="card-body p-4">
                <h1 class="h3 text-danger">Registro de usuario</h1>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input class="form-control" value="Carlos Admin">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input class="form-control" value="carlos@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="form-control" value="Admin123!">
                    </div>
                    <button class="btn btn-danger">Registrar</button>
                </form>
            </div>
        </div>
    </div>
</div>
HTML;
        break;

    case '/dashboard':
        $content = <<<HTML
<div class="row g-4 mb-4">
    <div class="col-md-4"><div class="card border-danger shadow-sm h-100"><div class="card-body"><h5 class="card-title">Usuarios</h5><p class="display-6 text-danger">3</p></div></div></div>
    <div class="col-md-4"><div class="card border-danger shadow-sm h-100"><div class="card-body"><h5 class="card-title">Comentarios</h5><p class="display-6 text-danger">7</p></div></div></div>
    <div class="col-md-4"><div class="card border-danger shadow-sm h-100"><div class="card-body"><h5 class="card-title">Archivos</h5><p class="display-6 text-danger">2</p></div></div></div>
</div>
<div class="row g-4">
    <div class="col-md-6 col-xl-3"><div class="card border-danger shadow-sm h-100"><div class="card-body"><h5 class="card-title">Comentarios</h5><p class="text-muted">Módulo para ver y publicar comentarios.</p><a href="/comments" class="btn btn-outline-danger">Abrir</a></div></div></div>
    <div class="col-md-6 col-xl-3"><div class="card border-danger shadow-sm h-100"><div class="card-body"><h5 class="card-title">Mi perfil</h5><p class="text-muted">Ver los datos del usuario actual.</p><a href="/profile/1" class="btn btn-outline-danger">Abrir</a></div></div></div>
    <div class="col-md-6 col-xl-3"><div class="card border-danger shadow-sm h-100"><div class="card-body"><h5 class="card-title">Subir archivo</h5><p class="text-muted">Subir archivos sin validación.</p><a href="/files" class="btn btn-outline-danger">Abrir</a></div></div></div>
    <div class="col-md-6 col-xl-3"><div class="card border-danger shadow-sm h-100"><div class="card-body"><h5 class="card-title">Herramienta de red</h5><p class="text-muted">Ejecuta comandos de ping con la entrada del usuario.</p><a href="/network/ping" class="btn btn-outline-danger">Abrir</a></div></div></div>
</div>
HTML;
        break;

    case '/comments':
        $content = <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-danger">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-danger">Comentarios</h2>
                <div class="alert alert-secondary">Total de comentarios: 3</div>
                <form class="mb-4">
                    <div class="mb-3">
                        <label class="form-label">Nuevo comentario</label>
                        <textarea class="form-control" rows="3" placeholder="Escribe un comentario"></textarea>
                    </div>
                    <button class="btn btn-danger">Guardar</button>
                </form>
                <h4 class="mt-4">Comentarios publicados</h4>
                <div class="border rounded p-3 mb-2"><div class="fw-bold text-danger">Ana</div><span>El laboratorio está funcionando.</span></div>
                <div class="border rounded p-3 mb-2"><div class="fw-bold text-danger">Luis</div><span>El panel de archivos acepta cualquier tipo.</span></div>
                <div class="border rounded p-3 mb-2"><div class="fw-bold text-danger">Marta</div><span>La herramienta de red puede ejecutar comandos arbitrarios.</span></div>
            </div>
        </div>
    </div>
</div>
HTML;
        break;

    case '/profile/1':
        $content = <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-sm border-danger">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-danger">Perfil de usuario</h2>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nombre:</strong> Carlos Admin</li>
                    <li class="list-group-item"><strong>Correo:</strong> carlos@example.com</li>
                    <li class="list-group-item"><strong>Rol:</strong> admin</li>
                    <li class="list-group-item"><strong>Estado:</strong> acceso normal</li>
                </ul>
            </div>
        </div>
    </div>
</div>
HTML;
        break;

    case '/files':
        $content = <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-danger">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-danger">Subir archivo</h2>
                <form enctype="multipart/form-data" class="mb-4">
                    <div class="mb-3">
                        <input type="file" class="form-control">
                    </div>
                    <button class="btn btn-danger">Subir</button>
                </form>
                <div class="alert alert-success">Último archivo subido: screenshot.png</div>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between"><span>invoice.pdf</span><span class="text-muted small">2026-08-01</span></li>
                    <li class="list-group-item d-flex justify-content-between"><span>notes.txt</span><span class="text-muted small">2026-08-01</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
HTML;
        break;

    case '/network/ping':
        $output = "PING 127.0.0.1 (127.0.0.1) 56(84) bytes of data.\n64 bytes from 127.0.0.1: icmp_seq=1 ttl=64 time=0.025 ms\n";
        $content = <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-danger">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-danger">Herramienta de red</h2>
                <form class="mb-3">
                    <label class="form-label">Host</label>
                    <input name="host" class="form-control" value="127.0.0.1">
                    <button class="btn btn-danger mt-3">Ejecutar ping</button>
                </form>
                <pre class="bg-dark text-light p-3 rounded">$output</pre>
            </div>
        </div>
    </div>
</div>
HTML;
        break;

    default:
        http_response_code(404);
        $content = '<div class="alert alert-danger">Página no encontrada.</div>';
        break;
}

renderPage('Laboratorio Security - V1', $content, 'danger');
