@extends('layouts.app')

@section('title', 'Inicio - V1')

@section('content')
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
@endsection
