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
        <hr class="my-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="#settingMenu" data-bs-toggle="collapse" class="nav-link">
                    <span data-feather="settings" class="align-text-bottom"></span> <span class="d-none d-sm-inline">Setting</span> </a>
                <ul class="collapse nav flex-column" id="settingMenu" data-bs-parent="#menu">
                    <li class="w-100">
                        <a href="{{ route('studio.setting.index') }}" class="nav-link"> <span class="d-none d-sm-inline">Profile</span></a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
