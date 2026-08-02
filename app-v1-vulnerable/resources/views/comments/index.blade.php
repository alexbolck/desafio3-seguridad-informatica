@extends('layouts.app')

@section('title', 'Comentarios - V1')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-danger">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-danger">Comentarios</h2>
                <div class="alert alert-secondary">Total de comentarios: {{ $totalComments }}</div>
                <form action="/comments" method="post" class="mb-4">
                    <div class="mb-3">
                        <label class="form-label">Nuevo comentario</label>
                        <textarea name="body" class="form-control" rows="3" placeholder="Escribe un comentario"></textarea>
                    </div>
                    <button class="btn btn-danger">Guardar</button>
                </form>

                <h4 class="mt-4">Comentarios publicados</h4>
                @foreach($comments as $comment)
                    <div class="border rounded p-3 mb-2">
                        <div class="fw-bold text-danger">{{ $comment->user->name ?? 'Usuario' }}</div>
                        {!! $comment->body !!}
                        <div class="text-muted small mt-2">{{ $comment->created_at }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
