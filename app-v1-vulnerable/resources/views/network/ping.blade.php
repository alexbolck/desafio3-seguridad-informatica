@extends('layouts.app')

@section('title', 'Ping - V1')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-danger">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-danger">Herramienta de red</h2>
                <form action="/ping" method="post" class="mb-4">
                    <div class="input-group">
                        <input type="text" name="host" value="{{ $host }}" class="form-control" placeholder="IP o host">
                        <button class="btn btn-danger">Ejecutar</button>
                    </div>
                </form>

                @if($output)
                    <div class="bg-dark text-light rounded p-3">
                        <pre class="mb-0">{{ $output }}</pre>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
