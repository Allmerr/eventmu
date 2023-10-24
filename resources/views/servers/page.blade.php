@extends('layouts.main')
@section('content')
<div class="container-fluid page-content">
    <div class="row">
        @foreach ($posts as $post)
            <div class="card" style="width: 18rem;">
                @if($post->image)
                <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ Str::limit($post->caption, 20) }}">
                @else
                <img src="https://source.unsplash.com/random/600x1000?nature" class="card-img-top" alt="{{ Str::limit($post->caption, 20) }}">
                @endif
                <div class="card-body">
                    <p class="card-text">{{ $post->caption }}</p>
                    <a href="#" class="btn btn-primary">Up</a>
                    <a href="#" class="btn btn-primary">Down</a>
                    <a href="{{ route('servers.post_detail', ['server' => $server->code, 'post' => $post->id]) }}" class="btn btn-primary">Detail</a>
                </div>
            </div>
        @endforeach
    </div>

</div>
@endsection
