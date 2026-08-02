@extends('layouts.app')

@section('title', 'Registro - V2')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm border-success">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-success">Registro</h2>
                <form action="/register" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nombre</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button class="btn btn-success">Crear cuenta</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
