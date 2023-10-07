welcome back

<a href="{{ route('server.index') }}">menu server</a>


<form action="{{ route('auth.logout') }}" method="post">
    @csrf
    <button class="btn btn-primary" type="submit"><i class="bi bi-box-arrow-right"></i>Logout</button>
</form>
