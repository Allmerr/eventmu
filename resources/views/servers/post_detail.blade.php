@extends('layouts.main')
@section('content')
<div class="container-fluid page-content">
    <div class="row">
        @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" class="" alt="{{ Str::limit($post->caption, 20) }}">
        @else
        <img src="https://source.unsplash.com/random/600x1000?nature" class="img-top" alt="{{ Str::limit($post->caption, 20) }}">
        @endif
        <div class="body">
            <p class="text">{{ $post->caption }}</p>
            <a href="{{ route('servers.post_up_votes', ['server' => $server->code, 'post' => $post->id]) }}" class="btn btn-primary">Up</a>
            <a href="{{ route('servers.post_down_votes', ['server' => $server->code, 'post' => $post->id]) }}" class="btn btn-primary">Down</a>
        </div>
    </div>

</div>
@endsection
