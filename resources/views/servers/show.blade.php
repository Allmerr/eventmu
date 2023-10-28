@extends('layouts.main')
@section('content')

<div class="container-fluid page-content">
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">{{ $server->name }}</h5>
            <h6 class="card-subtitle mb-2 text-muted">#{{ $server->code }}</h6>
            <h6 class="card-subtitle mb-2 text-muted">{{ $server->created_at }}</h6>
            <p class="card-text">{{ $server->description }}</p>

            @if(auth()->user()->hasFollowed($server->id))
            <a class="btn btn-primary" href="{{ route('servers.unfollow', $server->code) }}">UnFollow</a>
            @else
            <a class="btn btn-primary" href="{{ route('servers.follow', $server->code) }}">Follow</a>
            @endif

            <a class="btn btn-primary" href="{{ route('servers.page', $server->code) }}">Page</a>
        </div>
    </div>
</div>

@endsection
