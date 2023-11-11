@extends('layouts.main')
@section('content')

<div class="container-fluid page-content">

    <div class="row bg-body-tertiary py-4">
        @if($type === 'server')
        <h4>Introduce to you, {{ $server->name }}</h4>
        @elseif($type === 'user')
        <h4>Introduce to you, {{ $user->name }}</h4>
        @endif
    </div>



</div>

@endsection
