@extends('studio.layouts.main')
@section('content')

@push('css')
<style>
    table img {
        width: 300px;
    }
</style>
@endpush

<h1>Post</h1>

<div class="card">
    <div class="card-body">
        <a href="{{ route('studio.servers.posts.create', $server->code) }}" class="btn btn-primary mb-2">Create Post</a>
        <table id="table" class="table table-hover table-bordered table-stripped dataTable no-footer">
            <caption>Posts For {{ $server->name }}</caption>
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Caption</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($posts as $key => $post)
                    <tr>
                        <td>
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ Str::limit($post->caption, 20) }}">
                            @else
                                <img src="https://source.unsplash.com/random/600x1000?nature" alt="{{ Str::limit($post->caption, 20) }}">
                            @endif
                        </td>
                        <td>{{ $post->caption }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('studio.servers.posts.edit', ['server' => $server->code, 'post' => $post->id]) }}" class="btn btn-primary btn-xs edit-button">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('studio.servers.posts.destroy', ['server' => $server->code, 'post' => $post->id]) }}" class="btn btn-danger btn-xs mx-1" onclick="notificationBeforeDelete(event, this, <?php echo $key+1; ?>)">
                                    <i class="fa fa-trash"></i>
                                </a>
                                <a href="{{ route('studio.servers.posts.show', ['server' => $server->code, 'post' => $post->id]) }}" class="btn btn-info btn-xs mx-1">
                                    <i class="fa fa-info"></i>
                                </a>
                                <a href="{{ route('studio.servers.posts.votes', ['server' => $server->code, 'post' => $post->id]) }}" class="btn btn-secondary btn-xs mx-1">
                                    <i class="fa-solid fa-thumbs-up"></i>
                                </a>
                                <a href="{{ route('studio.servers.posts.comments', ['server' => $server->code, 'post' => $post->id]) }}" class="btn btn-secondary btn-xs mx-1">
                                    <i class="fa-solid fa-comments"></i>
                                </a>
                                <a href="#" class="btn btn-secondary btn-xs mx-1">
                                    <i class="fa-solid fa-chart-simple"></i>
                                </a>
                            </div>
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
