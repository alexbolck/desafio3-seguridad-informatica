<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Perfil</title>
</head>
<body>
    <h1>Perfil de {{ $user->name }}</h1>
    <p>Email: {{ $user->email }}</p>
    <p>Rol: {{ $user->role }}</p>
</body>
</html>
