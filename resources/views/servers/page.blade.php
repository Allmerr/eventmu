@extends('layouts.main')
@section('content')

@push('css')
    <style>
        .row .card {
            padding: 0px;
        }

    </style>
@endpush

<div class="container-fluid page-content mb-5">

    <div class="row bg-body-tertiary py-4 mb-4">
        <h4>See all posts from {{ $server->name }}</h4>
    </div>

    @foreach ($posts as $post)
        <div class="card" style="width: 18rem;">
            @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" class="card-img-top" alt="{{ Str::limit($post->caption, 20) }}">
            @else
            <img src="https://source.unsplash.com/random/600x1000?nature" class="card-img-top" alt="{{ Str::limit($post->caption, 20) }}">
            @endif
            <div class="card-body">
                <p class="card-text">{{ $post->caption }}</p>

                <div class="d-inline-block rounded p-0 bg-body-tertiary border">
                    <form action="{{ route('vote.store') }}" method="post" class="d-inline">
                        @csrf
                        <input type="hidden" name="type" value="post">
                        <input type="hidden" name="value" value="up">
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type="submit" class="btn text-secondary text-decoration-none"><i class="fa-solid fa-chevron-up"></i><span class="text-black"> {{ $post->countVotes() }} Upvotes</span></button>
                    </form>
                    <form action="{{ route('vote.store') }}" method="post" class="d-inline">
                        @csrf
                        <input type="hidden" name="type" value="post">
                        <input type="hidden" name="value" value="down">
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <button type="submit" class="btn text-secondary text-decoration-none"   ><i class="fa-solid fa-chevron-down"></i></button>
                    </form>
                </div>
                <a href="{{ route('servers.post_detail', ['server' => $server->code, 'post' => $post->id]) }}" class="d-inline-block rounded p-1 bg-body-tertiary border text-decoration-none">Detail</a>
            </div>
        </div>
    @endforeach
</div>
@endsection
