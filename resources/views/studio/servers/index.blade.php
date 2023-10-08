@extends('studio.layouts.main')
@section('content')

<h1>welcome</h1>

<div class="card">
    <div class="card-body">
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
                @foreach ($servers as $server)
                    <tr>
                        <td>{{ $server->name }}</td>
                        <td>{{ $server->code }}</td>
                        <td>{{ Str::limit($server->description, 50, '...') }}</td>
                        <td>
                            <a href="#" class="btn btn-primary btn-xs edit-button" data-toggle="modal"
                                data-target="#editModal{" data-id="">
                                <i class="fa fa-edit"></i>
                            </a>
                            <a href=""
                                onclick="notificationBeforeDelete(event, this, )" class="btn btn-danger btn-xs mx-1">
                                <i class="fa fa-trash"></i>
                            </a>
                            <a href="" class="btn btn-secondary btn-xs mx-1">
                                <i class="fa fa-user"></i>
                            </a>
                            <a href="" class="btn btn-info btn-xs mx-1">
                                <i class="fa fa-info"></i>
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
