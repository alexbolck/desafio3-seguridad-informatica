<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Comentarios</title>
</head>
<body>
    <h1>Comentarios</h1>
    <form action="/comments" method="post">
        @csrf
        <textarea name="body" placeholder="Escribe un comentario"></textarea>
        <button type="submit">Guardar</button>
    </form>

    <h2>Comentarios publicados</h2>
    @foreach($comments as $comment)
        <div>
            {{ $comment->body }}
        </div>
    @endforeach
</body>
</html>
