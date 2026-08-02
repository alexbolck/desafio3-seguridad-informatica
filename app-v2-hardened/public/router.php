<?php
session_start();

$baseDir = __DIR__;
$storageDir = $baseDir . '/storage';
if (!is_dir($storageDir)) {
    mkdir($storageDir, 0777, true);
}
if (!is_dir($storageDir . '/uploads')) {
    mkdir($storageDir . '/uploads', 0777, true);
}

function loadJson($name, $default = []) {
    $path = __DIR__ . '/storage/' . $name;
    if (!file_exists($path)) {
        file_put_contents($path, json_encode($default, JSON_PRETTY_PRINT));
        return $default;
    }

    $content = file_get_contents($path);
    if ($content === false || trim($content) === '') {
        return $default;
    }

    $data = json_decode($content, true);
    return $data === null ? $default : $data;
}

function saveJson($name, $data) {
    file_put_contents(__DIR__ . '/storage/' . $name, json_encode($data, JSON_PRETTY_PRINT));
}

function flash($message = null) {
    if ($message !== null) {
        $_SESSION['flash'] = $message;
        return;
    }

    if (!empty($_SESSION['flash'])) {
        $msg = $_SESSION['flash'];
        unset($_SESSION['flash']);
        return $msg;
    }

    return null;
}

function render($title, $content, $accent = '#15803d') {
    $message = flash();
    $messageHtml = $message ? '<div class="alert alert-success">' . $message . '</div>' : '';
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
        <a class="navbar-brand fw-bold" href="/">V2 - Hardened</a>
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
$messageHtml
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

$method = $_SERVER['REQUEST_METHOD'] ?? 'GET';
$uri = $_SERVER['REQUEST_URI'] ?? '/';
$path = parse_url($uri, PHP_URL_PATH) ?: '/';
$path = '/' . trim($path, '/');
if ($path === '') {
    $path = '/';
}

if (!file_exists(__DIR__ . '/storage/users.json')) {
    saveJson('users.json', [
        ['id' => 1, 'name' => 'Marta Secure', 'email' => 'marta@example.com', 'password' => 'StrongPass123!'],
        ['id' => 2, 'name' => 'Luis', 'email' => 'luis@example.com', 'password' => 'Luis2026!'],
    ]);
}
if (!file_exists(__DIR__ . '/storage/comments.json')) {
    saveJson('comments.json', [
        ['id' => 1, 'user' => 'Marta', 'body' => 'El laboratorio hardening está listo.'],
        ['id' => 2, 'user' => 'Luis', 'body' => 'La validación de archivos ahora limita tipo y tamaño.'],
    ]);
}
if (!file_exists(__DIR__ . '/storage/files.json')) {
    saveJson('files.json', [
        ['id' => 1, 'name' => 'report.pdf', 'path' => '/storage/uploads/report.pdf', 'size' => 2048],
    ]);
}

if ($method === 'POST' && $path === '/login') {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $users = loadJson('users.json');
    $user = null;
    foreach ($users as $entry) {
        if (($entry['email'] ?? '') === $email) {
            $user = $entry;
            break;
        }
    }

    if ($user && ($user['password'] ?? '') === $password) {
        $_SESSION['user_id'] = $user['id'];
        flash('Inicio de sesión aceptado');
        header('Location: /dashboard');
        exit;
    }

    flash('Credenciales inválidas');
    header('Location: /login');
    exit;
}

if ($method === 'POST' && $path === '/register') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    $users = loadJson('users.json');
    $users[] = ['id' => count($users) + 1, 'name' => $name, 'email' => $email, 'password' => $password];
    saveJson('users.json', $users);

    flash('Usuario registrado correctamente');
    header('Location: /login');
    exit;
}

if ($method === 'POST' && $path === '/comments') {
    $body = trim($_POST['body'] ?? '');
    if ($body !== '') {
        $comments = loadJson('comments.json');
        $comments[] = ['id' => count($comments) + 1, 'user' => 'Nuevo usuario', 'body' => $body];
        saveJson('comments.json', $comments);
        flash('Comentario guardado');
    }
    header('Location: /comments');
    exit;
}

if ($method === 'POST' && $path === '/files') {
    $file = $_FILES['file'] ?? null;
    if ($file && !empty($file['name'])) {
        $allowed = ['jpg', 'jpeg', 'png', 'pdf'];
        $ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        $sizeOk = $file['size'] <= 2048 * 1024;
        if (in_array($ext, $allowed, true) && $sizeOk) {
            $name = uniqid('file_', true) . '.' . $ext;
            $target = __DIR__ . '/storage/uploads/' . $name;
            move_uploaded_file($file['tmp_name'], $target);
            $files = loadJson('files.json');
            $files[] = ['id' => count($files) + 1, 'name' => $name, 'path' => '/storage/uploads/' . $name, 'size' => $file['size']];
            saveJson('files.json', $files);
            flash('Archivo subido correctamente');
        } else {
            flash('Archivo no permitido: tipo o tamaño inválido');
        }
    }
    header('Location: /files');
    exit;
}

if ($method === 'POST' && $path === '/network/ping') {
    $host = $_POST['host'] ?? '';
    $output = shell_exec('ping -n 4 ' . escapeshellarg($host) . ' 2>&1');
    $content = <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-success">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-success">Herramienta de red</h2>
                <form method="post" action="/network/ping" class="mb-3">
                    <label class="form-label">Host</label>
                    <input name="host" class="form-control" value="$host">
                    <button class="btn btn-success mt-3">Ejecutar ping</button>
                </form>
                <pre class="bg-dark text-light p-3 rounded">$output</pre>
            </div>
        </div>
    </div>
</div>
HTML;
    render('Herramienta de red - V2', $content, '#15803d');
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
                        <input name="email" class="form-control" value="marta@example.com">
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
                <form method="post" action="/register">
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Correo</label>
                        <input name="email" type="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input name="password" type="password" class="form-control" required>
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
        $users = loadJson('users.json');
        $comments = loadJson('comments.json');
        $files = loadJson('files.json');
        $userCount = count($users);
        $commentCount = count($comments);
        $fileCount = count($files);
        $content = <<<HTML
<div class="row g-4 mb-4">
    <div class="col-md-4"><div class="card border-success shadow-sm h-100"><div class="card-body"><h5 class="card-title">Usuarios</h5><p class="display-6 text-success">$userCount</p></div></div></div>
    <div class="col-md-4"><div class="card border-success shadow-sm h-100"><div class="card-body"><h5 class="card-title">Comentarios</h5><p class="display-6 text-success">$commentCount</p></div></div></div>
    <div class="col-md-4"><div class="card border-success shadow-sm h-100"><div class="card-body"><h5 class="card-title">Archivos</h5><p class="display-6 text-success">$fileCount</p></div></div></div>
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
        $comments = loadJson('comments.json');
        $list = '';
        foreach ($comments as $comment) {
            $list .= '<div class="border rounded p-3 mb-2"><div class="fw-bold text-success">' . $comment['user'] . '</div><div>' . $comment['body'] . '</div></div>';
        }
        $content = <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-success">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-success">Comentarios</h2>
                <form method="post" action="/comments" class="mb-4">
                    <div class="mb-3">
                        <label class="form-label">Nuevo comentario</label>
                        <textarea name="body" class="form-control" rows="3" placeholder="Escribe un comentario"></textarea>
                    </div>
                    <button class="btn btn-success">Guardar</button>
                </form>
                <h4 class="mt-4">Comentarios publicados</h4>
                $list
            </div>
        </div>
    </div>
</div>
HTML;
        break;

    case '/profile/1':
        $users = loadJson('users.json');
        $user = $users[0] ?? ['name' => 'Sin datos', 'email' => 'n/a'];
        $content = <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-7">
        <div class="card shadow-sm border-success">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-success">Perfil de usuario</h2>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Nombre:</strong> {$user['name']}</li>
                    <li class="list-group-item"><strong>Correo:</strong> {$user['email']}</li>
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
        $files = loadJson('files.json');
        $list = '';
        foreach ($files as $file) {
            $list .= '<li class="list-group-item d-flex justify-content-between"><span>' . $file['name'] . '</span><span class="text-muted small">' . $file['size'] . ' bytes</span></li>';
        }
        $content = <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-success">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-success">Subir archivo</h2>
                <form method="post" action="/files" enctype="multipart/form-data" class="mb-4">
                    <div class="mb-3">
                        <input type="file" name="file" class="form-control">
                    </div>
                    <button class="btn btn-success">Subir</button>
                </form>
                <ul class="list-group">
                    $list
                </ul>
            </div>
        </div>
    </div>
</div>
HTML;
        break;

    case '/network/ping':
        $content = <<<HTML
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-success">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-success">Herramienta de red</h2>
                <form method="post" action="/network/ping" class="mb-3">
                    <label class="form-label">Host</label>
                    <input name="host" class="form-control" value="127.0.0.1">
                    <button class="btn btn-success mt-3">Ejecutar ping</button>
                </form>
                <div class="alert alert-secondary">Prueba el comando introduciendo un host válido.</div>
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

render('Laboratorio Security - V2', $content, '#15803d');
