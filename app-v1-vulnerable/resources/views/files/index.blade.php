<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Subir archivo</title>
</head>
<body>
    <h1>Subir archivo</h1>
    <form action="/files" method="post" enctype="multipart/form-data">
        <input type="file" name="file">
        <button type="submit">Subir</button>
    </form>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif
</body>
</html>
