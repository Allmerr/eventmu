@extends('layouts.main')
@section('content')

@push('css')
<style>
.latest-post__image{
    width: 80px;
}

.comment-reply{
    margin-left: 50px;
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
            </div>
            <hr>
            <div class="comments-section mt-4">
                <form action="{{ route('comment.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="type" value="post">
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <input type="text" name="content" class="form-control @error('content') is-invalid @enderror" id="comment" placeholder="comments">
                    @error('content')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary mt-2" id="comment-btn">Comment</button>
                    </div>
                </form>
                <div class="comments mt-4">
                    @foreach ($post->comments as $comment)
                    <div class="comment p-1 rounded">
                        <div class="d-flex justify-content-between">
                            <h6 class="comment__username"><a href="#" class="text-decoration-none text-muted"><b>{{ $comment->user->name }}</b></a> - {{ $comment->created_at->diffForHumans() }}</h6>
                            <div class="d-inline-block rounded p-1 bg-body-tertiary border">
                                <form action="{{ route('vote.store') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="type" value="comment">
                                    <input type="hidden" name="value" value="up">
                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                    <button type="submit" class="btn text-secondary text-decoration-none"><i class="fa-solid fa-chevron-up"></i><span class="text-black"> {{ $comment->countVotes() }} Upvotes</span></button>
                                </form>
                                <form action="{{ route('vote.store') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="type" value="comment">
                                    <input type="hidden" name="value" value="down">
                                    <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                    <button type="submit" class="btn text-secondary text-decoration-none"   ><i class="fa-solid fa-chevron-down"></i></button>
                                </form>
                                <span>|</span>
                                @if($comment->user_id == Auth::id())
                                <a href="{{ route('comment.destroy', $comment->id) }}" class="text-danger" onclick="notificationBeforeDelete(event, this, 1)"><i class="fa-solid fa-trash"></i></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editCommentModal{{$comment->id}}" class="text-warning"><i class="fa-solid fa-pen"></i></a>
                                @else
                                <a href="#" class="text-muted text-decoration-none"><i class="fa-regular fa-flag"></i></a>
                                @endif
                                <a href="#" data-bs-toggle="modal" data-bs-target="#replyCommentModal{{$comment->id}}" class="text-primary text-decoration-none"><i class="fa-regular fa-comments"></i></a>
                            </div>
                        </div>
                        <p class="comment__content text-end">{{ $comment->content }}</p>
                    </div>
                    @foreach ($comment->replies as $reply)
                    <div class="comment-reply p-1 rounded">
                        <div class="d-flex justify-content-between">
                            <h6 class="comment-reply__username"><a href="#" class="text-decoration-none text-muted"><b>{{ $reply->user->name }}</b></a> - {{ $reply->created_at->diffForHumans() }}</h6>
                            <div class="d-inline-block rounded p-1 bg-body-tertiary border">
                                <form action="{{ route('vote.store') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="type" value="comment">
                                    <input type="hidden" name="value" value="up">
                                    <input type="hidden" name="comment_id" value="{{ $reply->id }}">
                                    <button type="submit" class="btn text-secondary text-decoration-none"><i class="fa-solid fa-chevron-up"></i><span class="text-black"> {{ $reply->countVotes() }} Upvotes</span></button>
                                </form>
                                <form action="{{ route('vote.store') }}" method="post" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="type" value="comment">
                                    <input type="hidden" name="value" value="down">
                                    <input type="hidden" name="comment_id" value="{{ $reply->id }}">
                                    <button type="submit" class="btn text-secondary text-decoration-none"   ><i class="fa-solid fa-chevron-down"></i></button>
                                </form>
                                <span>|</span>
                                @if($comment->user_id == Auth::id())
                                <a href="{{ route('comment.destroy', $reply->id) }}" class="text-danger" onclick="notificationBeforeDelete(event, this, 1)"><i class="fa-solid fa-trash"></i></a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#editCommentModal{{$reply->id}}" class="text-warning"><i class="fa-solid fa-pen"></i></a>
                                @else
                                <a href="#" class="text-muted text-decoration-none"><i class="fa-regular fa-flag"></i></a>
                                @endif
                            </div>
                        </div>
                        <p class="comment-reply__content text-end">{{ $reply->content }}</p>
                    </div>
                    @endforeach
                    @endforeach
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

@foreach($post->comments as $comment)
<div class="modal fade" id="editCommentModal{{$comment->id}}" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Comment</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="{{ route('comment.update',$comment->id) }}" method="POST" id="form" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content">Comment</label>
                                        <input type="text"
                                            class="form-control @error('content') is-invalid @enderror"
                                            id="content" name="content" required
                                            value="{{ old('content', $comment->content) }}">
                                        @error('content')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@foreach ($comment->replies as $reply)
<div class="modal fade" id="editCommentModal{{$reply->id}}" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Data Reply</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="{{ route('comment.update',$reply->id) }}" method="POST" id="form" class="form-horizontal">
                    @csrf
                    @method('PUT')
                    <div class="form-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="content">Reply</label>
                                        <input type="text"
                                            class="form-control @error('content') is-invalid @enderror"
                                            id="content" name="content" required
                                            value="{{ old('content', $reply->content) }}">
                                        @error('content')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
@endforeach
@endforeach


@foreach($post->comments as $comment)
<div class="modal fade" id="replyCommentModal{{$comment->id}}" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Reply comment</h4>
                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"></span>
                </button>
            </div>
            <div class="modal-body form">
                <form action="{{ route('comment.store') }}" method="POST" id="form" class="form-horizontal">
                    @csrf
                    <div class="form-body">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="hidden" name="type" value="comment">
                                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                                        <label for="content">Comment</label>
                                        <input type="text"
                                            class="form-control @error('content') is-invalid @enderror"
                                            id="content" name="content"
                                            value="{{ old('content') }}" required>
                                        @error('content')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection
