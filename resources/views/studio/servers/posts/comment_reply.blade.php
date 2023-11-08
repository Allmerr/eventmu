@extends('studio.layouts.main')
@section('content')

<h1>Replies</h1>

<div class="card">
    <div class="card-body">
        <table id="table" class="table table-hover table-bordered table-stripped dataTable no-footer">
            <h6>Total replies {{ $replies->count() }}</h6>
            <caption>replies</caption>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Content</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($replies as $key => $reply)
                    <tr>
                        <td>{{ $reply->user->name }}</td>
                        <td>{{ $reply->content }}</td>
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
