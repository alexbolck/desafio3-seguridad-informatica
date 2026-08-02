@extends('layouts.app')

@section('title', 'Login - V2')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm border-success">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-success">Inicio de sesión</h2>
                <form action="/login" method="post">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contraseña</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <button class="btn btn-success">Entrar</button>
                </form>
                @if($errors->any())
                    <div class="alert alert-danger mt-3">{{ $errors->first() }}</div>
                @endif
                @if(session('success'))
                    <div class="alert alert-success mt-3">{{ session('success') }}</div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
