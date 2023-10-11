@extends('studio.layouts.main')
@section('content')

<h1>Create Server</h1>

<div class="card">
    <div class="card-body">
        <form action="{{ route('studio.servers.store') }}" method="post">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="name" name="name" id="name"
                 class="form-control @error('name') is-invalid @enderror"
                 placeholder="Name" value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">description</label>
                <input type="description" name="description" id="description"
                 class="form-control @error('description') is-invalid @enderror"
                 placeholder="description" value="{{ old('description') }}">
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
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
