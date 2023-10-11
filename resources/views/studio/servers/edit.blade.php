@extends('studio.layouts.main')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <h1 class="text-center">Edit Server</h1>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('studio.servers.update', $server->code) }}" method="post">
                        @method('PATCH')
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="name" name="name" id="name"
                             class="form-control @error('name') is-invalid @enderror"
                             placeholder="Name" value="{{ old('name', $server->name) }}">
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
                             placeholder="description" value="{{ old('description', $server->description) }}">
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
        </div>
    </div>
</div>

@endsection
