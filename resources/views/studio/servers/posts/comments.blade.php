@extends('studio.layouts.main')
@section('content')

<h1>Comments</h1>

<div class="card">
    <div class="card-body">
        <table id="table" class="table table-hover table-bordered table-stripped dataTable no-footer">
            <h6>Total Comments {{ $post->countComments() }}</h6>
            <caption>Comments</caption>
            <thead>
                <tr>
                    <th>Nickname</th>
                    <th>Content</th>
                    <th>Time</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $key => $comment)
                    <tr>
                        <td>{{ $comment->user->nicknme }}</td>
                        <td>{{ $comment->content }}</td>
                        <td>{{ $comment->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="{{  route('studio.servers.posts.comment_reply', ['server' => $server->code, 'post' => $post->code, 'comment' => $comment->id]) }}" class="btn btn-secondary btn-xs mx-1">
                                Reply
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@push('js')
<script>
$(document).ready( function () {
    $('#table').DataTable({
        responsive: true,
    });
} );
</script>
@endpush

@endsection
