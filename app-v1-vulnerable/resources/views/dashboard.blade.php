@extends('layouts.app')

@section('title', 'Dashboard - V1')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-danger shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Usuarios</h5>
                <p class="display-6 text-danger">{{ $users }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-danger shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Comentarios</h5>
                <p class="display-6 text-danger">{{ $comments }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-danger shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Archivos</h5>
                <p class="display-6 text-danger">{{ $files }}</p>
            </div>
        </div>
    </div>
</div>
<div class="row g-4">
    <div class="col-md-6 col-xl-3">
        <div class="card border-danger shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Comentarios</h5>
                <p class="text-muted">Módulo para ver y publicar comentarios.</p>
                <a href="/comments" class="btn btn-outline-danger">Abrir</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card border-danger shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Mi perfil</h5>
                <p class="text-muted">Ver los datos del usuario actual.</p>
                <a href="/profile/1" class="btn btn-outline-danger">Abrir</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card border-danger shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Subir archivo</h5>
                <p class="text-muted">Subir archivos sin validación.</p>
                <a href="/files" class="btn btn-outline-danger">Abrir</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card border-danger shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Herramienta de red</h5>
                <p class="text-muted">Ejecuta comandos de ping con la entrada del usuario.</p>
                <a href="/network/ping" class="btn btn-outline-danger">Abrir</a>
            </div>
        </div>
    </div>
</div>
@endsection
