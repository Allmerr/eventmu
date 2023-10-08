@extends('layouts.main')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mt-5">
            <h1 class="text-center">Register</h1>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('auth.proccess_register') }}" method="post">
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

                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation"
                             placeholder="Confirm Password"
                             class="form-control @error('password_confirmation') is-invalid @enderror">
                            @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>


                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            </div>
            <div class="text-center mt-3">
                <a href="{{ route('auth.login') }}">Login</a>
            </div>
        </div>
    </div>
</div>

    @endsection
