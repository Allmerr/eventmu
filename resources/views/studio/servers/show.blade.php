@extends('studio.layouts.main')
@section('content')

<h1>Show Server</h1>

<div class="card">
    <div class="card-body">
        <form action="#" method="post">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="name" name="name" id="name"
                 class="form-control @error('name') is-invalid @enderror"
                 placeholder="Name" value="{{ $server->name }}" disabled>
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
                 placeholder="description" value="{{ $server->description }}" disabled>
                @error('description')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </form>
    </div>
</div>

@endsection
