@extends('layouts.app')

@section('title', 'Archivos - V2')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-success">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-success">Subir archivo</h2>
                <form action="/files" method="post" enctype="multipart/form-data" class="mb-4">
                    @csrf
                    <div class="mb-3">
                        <input type="file" name="file" class="form-control">
                    </div>
                    <button class="btn btn-success">Subir</button>
                </form>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($files->isNotEmpty())
                    <h4 class="mt-4">Archivos subidos</h4>
                    <ul class="list-group">
                        @foreach($files as $file)
                            <li class="list-group-item d-flex justify-content-between">
                                <span>{{ $file->filename }}</span>
                                <span class="text-muted small">{{ $file->created_at }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
