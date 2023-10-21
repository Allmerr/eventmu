@extends('studio.layouts.main')
@section('content')

<div class="card">
    <div class="card-body">
        <table id="table" class="table table-hover table-bordered table-stripped dataTable no-footer">
            <caption>Followers {{ $server->name }}</caption>
            <thead>
                <tr>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($followers as $key => $follower)
                    <tr>
                        <td>{{ $follower->user->name }}</td>
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
