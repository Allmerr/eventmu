@extends('studio.layouts.main')
@section('content')

<div class="card">
    <div class="card-body">
        <a href="{{ route('studio.servers.create') }}" class="btn btn-primary mb-2">Create Server</a>
        <table id="table" class="table table-hover table-bordered table-stripped dataTable no-footer">
            <caption>Data Server For Users</caption>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($servers as $key => $server)
                    <tr>
                        <td>{{ $server->name }}</td>
                        <td>{{ $server->code }}</td>
                        <td>{{ Str::limit($server->description, 50, '...') }}</td>
                        <td>
                            <a href="{{ route('studio.servers.edit', $server->code) }}" class="btn btn-primary btn-xs edit-button">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href="{{ route('studio.servers.destroy', $server->code) }}" class="btn btn-danger btn-xs mx-1" onclick="notificationBeforeDelete(event, this, <?php echo $key+1; ?>)">
                                <i class="fa fa-trash"></i>
                            </a>
                            <a href="{{ route('studio.servers.show', $server->code) }}" class="btn btn-info btn-xs mx-1">
                                <i class="fa fa-info"></i>
                            </a>
                            <a href="{{ route('studio.servers.posts.index', $server->code) }}" class="btn btn-success btn-xs mx-1">
                                <i class="fas fa-bullhorn"></i>
                            </a>
                            <a href="{{ route('studio.servers.follower', $server->code) }}" class="btn btn-secondary btn-xs mx-1">
                                <i class="fa-solid fa-users"></i>
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
        responsive: true
    });
} );
</script>
@endpush

@endsection
