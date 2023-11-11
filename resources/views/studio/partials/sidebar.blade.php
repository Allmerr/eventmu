<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('home') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">
                <span data-feather="home" class="align-text-bottom"></span>
                Home
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('studio/servers*') ? 'active' : '' }}" href="{{ route('studio.servers.index') }}">
                <span data-feather="file-text" class="align-text-bottom"></span>
                Servers
                </a>
            </li>
        </ul>
    </div>
</nav>
