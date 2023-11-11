@extends('studio.layouts.main')
@section('content')

@push('css')
<style>
    .card img {
        width: 300px;
    }
</style>
@endpush

<h1>Post</h1>

<div class="card">
    <div class="card-body">
        <h6 style="color:#696969">Create at {{ $post->created_at }}</h6>
        @if($post->image)
        <img src="{{ asset('storage/' . $post->image) }}" alt="{{ Str::limit($post->caption, 20) }}">
        @else
        <img src="https://source.unsplash.com/random/1000x1000" alt="{{ Str::limit($post->caption, 20) }}">
        @endif
        <br>
        {!! $post->caption !!}
        <br>
    </div>
</div>

@endsection
