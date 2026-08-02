@extends('layouts.app')

@section('title', 'Ping - V2')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card shadow-sm border-success">
            <div class="card-body p-4">
                <h2 class="card-title mb-3 text-success">Herramienta de red</h2>
                <form action="/network/ping" method="post" class="mb-4">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="host" value="{{ $host }}" class="form-control" placeholder="IP o host">
                        <button class="btn btn-success">Ejecutar</button>
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
