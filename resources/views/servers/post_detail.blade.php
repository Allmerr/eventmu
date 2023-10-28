@extends('layouts.main')
@section('content')

@push('css')
<style>
.latest-post__image{
    width: 80px;
}

@media(max-width: 768px){
    .post{
        gap: 50px;
    }
}
</style>
@endpush

<div class="container-fluid page-content my-5 pt-5">
    <div class="row post">
        <div class="col-md-8">
            @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ Str::limit($post->caption, 20) }}" class="mx-auto img-thumbnail m-2">
            @else
            <img src="https://source.unsplash.com/random/600x1000?nature" alt="{{ Str::limit($post->caption, 20) }}" class="mx-auto img-thumbnail m-2">
            @endif
            <div class="body mt-2">
                <p class="text">{{ $post->caption }}</p>
                <div class="d-inline-block rounded p-1 bg-body-tertiary border">
                    <a href="{{ route('servers.post_up_votes', ['server' => $server->code, 'post' => $post->id]) }}" class="text-secondary text-decoration-none"><i class="fa-solid fa-chevron-up"></i><span class="text-black"> {{ $post->countVotes() }} Upvotes</span></a>
                    <a href="{{ route('servers.post_down_votes', ['server' => $server->code, 'post' => $post->id]) }}" class="text-secondary"><i class="fa-solid fa-chevron-down"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <h5>Latest post from this server</h5>
            <div class="latest-posts">
                @foreach ($posts as $post)
                <div class="latest-post d-flex align-items-center rounded p-1 justify-content-around border mb-2">
                    <img src="{{ asset('storage/' .  $post->image ) }}" alt="{{ Str::limit($post->caption, 20) }}" class="latest-post__image">
                    <h6 class=""><a href="{{ route('servers.post_detail', ['server' => $server->code, 'post' => $post->id]) }}" class="text-decoration-none">{{ Str::limit($post->caption, 35) }}</a></h6>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</div>
@endsection
