@extends('layouts.main')
@section('content')
<div class="container-fluid page-content">
    <div class="row bg-body-tertiary py-4">
        <h4>Manage and Create your own <a href="{{ route('studio.servers.index') }}" class="text-decoration-none">server</a></h4>
    </div>

    <div class="row my-5">
        @foreach ($servers as $server)
            @if($server->user_id !== Auth::user()->id)
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('servers.show', $server->code) }}" class="text-decoration-none">{{ $server->name }}</a>
                        </h5>
                        <h6 class="card-subtitle mb-2 text-muted">{{ $server->user->name }}</h6>
                        <p class="card-text">{{ Str::limit($server->description, 50) }}</p>

                        <small class="d-block text-muted "><b>{{ $server->countFollowers() }}  Followers</b></small>
                        <br>

                        @if(auth()->user()->hasFollowed($server->id))
                        <a class="btn btn-primary" href="{{ route('servers.unfollow', $server->code) }}">UnFollow</a>
                        @else
                        <a class="btn btn-primary" href="{{ route('servers.follow', $server->code) }}">Follow</a>
                        @endif
                    </div>
                </div>
            </div>
            @endif
        @endforeach
    </div>

</div>
@endsection
