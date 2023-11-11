@extends('studio.layouts.main')
@section('content')

<h1>Votes</h1>

<div class="card">
    <div class="card-body">
        <table id="table" class="table table-hover table-bordered table-stripped dataTable no-footer">
            <h6>Total Votes {{ $post->countVotes() }}</h6>
            <caption>Votes</caption>
            <thead>
                <tr>
                    <th>Nickname</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($votes as $key => $vote)
                    <tr>
                        <td><a href="{{ route('profile', $vote->user->nickname) }}">{{ $vote->user->nickname }}</a></td>
                        <td>{{ $vote->value }}</td>
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
