@extends('layouts.main')
@section('body')

<h1>
    Welcome to Eventmu,
    <br>
        <a href="{{ route('auth.login') }}">Login</a>
    <br>
        <a href="{{ route('auth.register') }}">register</a>
</h1>

@section('body')
