<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Ping</title>
</head>
<body>
    <h1>Ping</h1>
    <form action="/ping" method="post">
        <input type="text" name="host" value="{{ $host }}" placeholder="IP o host">
        <button type="submit">Ejecutar</button>
    </form>

    @if($output)
        <pre>{{ $output }}</pre>
    @endif
</body>
</html>
