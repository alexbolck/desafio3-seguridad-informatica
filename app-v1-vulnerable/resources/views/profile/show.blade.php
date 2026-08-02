@extends('layouts.app')

@section('title', 'Perfil - V1')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-6">
        <div class="card shadow-sm border-danger">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-danger">Perfil de {{ $user->name }}</h2>
                <ul class="list-group">
                    <li class="list-group-item"><strong>Email:</strong> {{ $user->email }}</li>
                    <li class="list-group-item"><strong>Rol:</strong> {{ $user->role }}</li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
