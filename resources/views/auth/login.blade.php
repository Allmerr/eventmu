@extends('layouts.main')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <h1 class="text-center">Login</h1>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('auth.login') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" name="email" id="email"
                             class="form-control @error('email') is-invalid @enderror"
                             placeholder="Email address" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password"
                             placeholder="Password"
                             class="form-control @error('password') is-invalid @enderror">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('auth.register') }}">Register</a>
            </div>
        </div>
    </div>

@endsection

