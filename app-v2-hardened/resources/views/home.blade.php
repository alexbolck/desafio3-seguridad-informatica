@extends('layouts.app')

@section('title', 'Inicio - V2')

@section('content')
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
@endsection
