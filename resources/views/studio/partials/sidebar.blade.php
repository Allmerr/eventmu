<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('studio') ? 'active' : '' }}" aria-current="page" href="{{ route('studio.index') }}">
                <span data-feather="home" class="align-text-bottom"></span>
                Studio
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::is('studio/servers*') ? 'active' : '' }}" href="{{ route('studio.servers.index') }}">
                <span data-feather="file-text" class="align-text-bottom"></span>
                My Server
                </a>
            </li>
        </ul>
        @can('isAdmin')
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted"><span>Administrator</span></h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard/category*') ? 'active' : '' }}" aria-current="page" href="/dashboard/category">
                <span data-feather="grid" class="align-text-bottom"></span>
                Category
                </a>
            </li>
        </ul>
        @endcan
    </div>
</nav>