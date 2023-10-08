@extends('layouts.main')
@section('body')
<div class="container-fluid mt-2">
    <a class="btn btn-primary" href="{{ route('servers.create') }}">Create server</a>
    <br>
    <br>

    <div class="row">
        @foreach ($servers as $server)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{ $server->name }}</h5>
                        <h6 class="card-subtitle mb-2 text-muted">#{{ $server->code }}</h6>
                        <p class="card-text">{{ Str::limit($server->description, 30) }}</p>
                        <a class="btn btn-primary" href="#">Follow</a>
                        <a class="btn btn-primary" href="{{ route('servers.show', $server->code) }}">Detail</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
