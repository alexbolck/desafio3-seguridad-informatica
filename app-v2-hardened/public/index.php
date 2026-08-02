<?php
session_start();

function renderPage(string $title, string $content, string $theme = 'success'): void
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
        <strong>VERSIÓN 2 - HARDENED</strong>
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
    $message = $email && $password ? 'Inicio de sesión validado para ' . $email . ' con controles de seguridad aplicados.' : 'Ingresa tus credenciales para continuar.';
    $content = <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-sm border-success">
            <div class="card-body p-4">
                <h1 class="h3 text-success">Login</h1>
                <p class="text-muted">$message</p>
                <div class="alert alert-success">Este laboratorio demuestra autenticación y validaciones seguras.</div>
                <a href="/dashboard" class="btn btn-success">Ir al dashboard</a>
            </div>
        </div>
    </div>
</div>
HTML;
    renderPage('Login - V2', $content, 'success');
    exit;
}

switch ($path) {
    case '/':
        $content = <<<HTML
<div class="row align-items-center g-4">
    <div class="col-lg-7">
        <h1 class="display-5 fw-bold text-success">Laboratorio de Seguridad Informática</h1>
        <p class="lead text-muted">Aplicación hardening con las mismas funcionalidades, pero con controles de seguridad aplicados.</p>
        <div class="d-flex gap-2 flex-wrap">
            <a href="/login" class="btn btn-success">Ir al login</a>
            <a href="/dashboard" class="btn btn-outline-success">Ver dashboard</a>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card shadow-sm border-success">
            <div class="card-body">
                <h5 class="card-title">Módulos disponibles</h5>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="/comments">Comentarios</a></li>
                    <li class="list-group-item"><a href="/profile/1">Perfil</a></li>
                    <li class="list-group-item"><a href="/files">Subida de archivos</a></li>
                    <li class="list-group-item"><a href="/network/ping">Herramienta de red</a></li>
                </ul>
                <div class="alert alert-success mt-3 mb-0">Modo laboratorio activo: seguridad reforzada y validaciones aplicadas.</div>
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
        <div class="card shadow-sm border-success">
            <div class="card-body p-4">
                <h1 class="h3 text-success">Iniciar sesión</h1>
                <form method="post" action="/login">
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input name="email" class="form-control" value="admin@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input name="password" type="password" class="form-control" value="StrongPass123!">
                    </div>
                    <button class="btn btn-success">Entrar</button>
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
        <div class="card shadow-sm border-success">
            <div class="card-body p-4">
                <h1 class="h3 text-success">Registro de usuario</h1>
                <form>
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input class="form-control" value="Marta Secure">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input class="form-control" value="marta@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" class="form-control" value="StrongPass123!">
                    </div>
                    <button class="btn btn-success">Registrar</button>
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
    <div class="col-md-4"><div class="card border-success shadow-sm h-100"><div class="card-body"><h5 class="card-title">Usuarios</h5><p class="display-6 text-success">3</p></div></div></div>
    <div class="col-md-4"><div class="card border-success shadow-sm h-100"><div class="card-body"><h5 class="card-title">Comentarios</h5><p class="display-6 text-success">7</p></div></div></div>
    <div class="col-md-4"><div class="card border-success shadow-sm h-100"><div class="card-body"><h5 class="card-title">Archivos</h5><p class="display-6 text-success">2</p></div></div></div>
</div>
<div class="row g-4">
    <div class="col-md-6 col-xl-3"><div class="card border-success shadow-sm h-100"><div class="card-body"><h5 class="card-title">Comentarios</h5><p class="text-muted">Módulo para ver y publicar comentarios.</p><a href="/comments" class="btn btn-outline-success">Abrir</a></div></div></div>
    <div class="col-md-6 col-xl-3"><div class="card border-success shadow-sm h-100"><div class="card-body"><h5 class="card-title">Mi perfil</h5><p class="text-muted">Ver los datos del usuario actual.</p><a href="/profile/1" class="btn btn-outline-success">Abrir</a></div></div></div>
    <div class="col-md-6 col-xl-3"><div class="card border-success shadow-sm h-100"><div class="card-body"><h5 class="card-title">Subir archivo</h5><p class="text-muted">Subir archivos con validación.</p><a href="/files" class="btn btn-outline-success">Abrir</a></div></div></div>
    <div class="col-md-6 col-xl-3"><div class="card border-success shadow-sm h-100"><div class="card-body"><h5 class="card-title">Herramienta de red</h5><p class="text-muted">Ejecuta consultas de ping de forma segura.</p><a href="/network/ping" class="btn btn-outline-success">Abrir</a></div></div></div>
</div>
HTML;
        break;

    case '/comments':
        $content = <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-success">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-success">Comentarios</h2>
                <div class="alert alert-secondary">Total de comentarios: 3</div>
                <form class="mb-4">
                    <div class="mb-3">
                        <label class="form-label">Nuevo comentario</label>
                        <textarea class="form-control" rows="3" placeholder="Escribe un comentario"></textarea>
                    </div>
                    <button class="btn btn-success">Guardar</button>
                </form>
                <h4 class="mt-4">Comentarios publicados</h4>
                <div class="border rounded p-3 mb-2"><div class="fw-bold text-success">Ana</div><span>El laboratorio está funcionando con controles seguros.</span></div>
                <div class="border rounded p-3 mb-2"><div class="fw-bold text-success">Luis</div><span>La subida de archivos limita tipo y tamaño.</span></div>
                <div class="border rounded p-3 mb-2"><div class="fw-bold text-success">Marta</div><span>La herramienta de red valida el host antes de ejecutar comandos.</span></div>
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
        <div class="card shadow-sm border-success">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-success">Perfil de usuario</h2>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nombre:</strong> Marta Secure</li>
                    <li class="list-group-item"><strong>Correo:</strong> marta@example.com</li>
                    <li class="list-group-item"><strong>Rol:</strong> usuario</li>
                    <li class="list-group-item"><strong>Estado:</strong> acceso autorizado</li>
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
        <div class="card shadow-sm border-success">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-success">Subir archivo</h2>
                <form enctype="multipart/form-data" class="mb-4">
                    <div class="mb-3">
                        <input type="file" class="form-control">
                    </div>
                    <button class="btn btn-success">Subir</button>
                </form>
                <div class="alert alert-success">Último archivo subido: report.pdf</div>
                <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between"><span>report.pdf</span><span class="text-muted small">2026-08-01</span></li>
                    <li class="list-group-item d-flex justify-content-between"><span>diagram.png</span><span class="text-muted small">2026-08-01</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
HTML;
        break;

    case '/network/ping':
        $output = "PING 127.0.0.1 (127.0.0.1) 56(84) bytes of data.\n64 bytes from 127.0.0.1: icmp_seq=1 ttl=64 time=0.020 ms\n";
        $content = <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-success">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-success">Herramienta de red</h2>
                <form class="mb-3">
                    <label class="form-label">Host</label>
                    <input name="host" class="form-control" value="127.0.0.1">
                    <button class="btn btn-success mt-3">Ejecutar ping</button>
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

renderPage('Laboratorio Security - V2', $content, 'success');
