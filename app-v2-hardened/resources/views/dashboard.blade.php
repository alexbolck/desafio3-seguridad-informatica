@extends('layouts.app')

@section('title', 'Dashboard - V2')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card border-success shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Usuarios</h5>
                <p class="display-6 text-success">{{ $users }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-success shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Comentarios</h5>
                <p class="display-6 text-success">{{ $comments }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-success shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Archivos</h5>
                <p class="display-6 text-success">{{ $files }}</p>
            </div>
        </div>
    </div>
</div>
<div class="row g-4">
    <div class="col-md-6 col-xl-3">
        <div class="card border-success shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Comentarios</h5>
                <p class="text-muted">Módulo para ver y publicar comentarios.</p>
                <a href="/comments" class="btn btn-outline-success">Abrir</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card border-success shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Mi perfil</h5>
                <p class="text-muted">Ver los datos del usuario actual.</p>
                <a href="/profile/1" class="btn btn-outline-success">Abrir</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card border-success shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Subir archivo</h5>
                <p class="text-muted">Subir archivos con validación.</p>
                <a href="/files" class="btn btn-outline-success">Abrir</a>
            </div>
        </div>
    </div>
    <div class="col-md-6 col-xl-3">
        <div class="card border-success shadow-sm h-100">
            <div class="card-body">
                <h5 class="card-title">Herramienta de red</h5>
                <p class="text-muted">Ejecuta consultas de ping de forma segura.</p>
                <a href="/network/ping" class="btn btn-outline-success">Abrir</a>
            </div>
        </div>
    </div>
</div>
@endsection
