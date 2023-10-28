@extends('layouts.main')
@section('content')

<div class="container-fluid page-content">

    <div class="row bg-body-tertiary py-4">
        <h4>welcome back, see our great server and forums</h4>
    </div>

    <div class="row servers-feed mt-5 mb-5">
        <h1 class="mb-3">See all the <a href="{{ route('servers.index') }}" class="text-decoration-none">servers</a> availabe</h1>

        <div class="row">
            @foreach ($servers as $server)
                <div class="col-md-4 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <a href="{{ route('servers.show', $server->code) }}" class="text-decoration-none">
                                <div class="card-title">{{ $server->name }}</div>
                            </a>
                            <h6 class="card-subtitle mb-2 text-body-secondary">{{ $server->user->name }}</h6>
                            <p class="card-text">{{ Str::limit($server->description, 100) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>

</div>

@endsection
