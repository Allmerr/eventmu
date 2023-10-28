<div class="fixed-top navbar-container">
    <div class="bg-dark text-white">
        <div class="container-fluid">
            <ul class="list-unstyled pre-navbar">
                @guest
                <li class="mx-2">
                    <a href="{{ route('login') }}" class="text-decoration-none text-white">Login</a>
                </li>
                <li class="mx-2">
                    <a href="{{ route('register') }}" class="text-decoration-none text-white">Register</a>
                </li>
                @endguest
                @auth
                <li class="mx-2">
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="nav-link" type="submit">Logout</button>
                    </form>
                </li>
                @endauth
            </ul>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" @auth href="{{ route('home') }}" @else href="{{ route('welcome') }}" @endauth>EventMu</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('servers.index') }}">Servers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('studio.index') }}">Studio</a>
                    </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
</div>
