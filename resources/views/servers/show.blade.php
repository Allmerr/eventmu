@extends('layouts.main')
@section('body')

<div class="container-fluid">
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $server->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">#{{ $server->code }}</h6>
            <h6 class="card-subtitle mb-2 text-muted">{{ $server->created_at }}</h6>
            <p class="card-text">{{ $server->description }}</p>
            <a class="btn btn-primary" href="#">Follow</a>
            <a class="btn btn-primary" href="#">Detail</a>
        </div>
    </div>
</div>

@endsection
