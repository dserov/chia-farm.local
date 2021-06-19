<nav class='navbar navbar-vertical fixed-left navbar-expand-md navbar-light' id='sidebar'>
    <div class='container-fluid'>
        <!-- Toggler -->
        <button aria-controls='sidebarCollapse' aria-expanded='false' aria-label='Toggle navigation'
                class='navbar-toggler' data-target='#sidebarCollapse' data-toggle='collapse' type='button'>
            <span class='navbar-toggler-icon'></span>
        </button>
        <!-- Brand -->
        <a class='navbar-brand' href='/'>
            <img class="navbar-brand-img mx-auto"
                 src="/assets/logo-98e7658e324187e464bed5461eaad0861810bba7c427e519195ba309df52e6be.svg"/>
        </a>
        <!-- User (xs) -->
        <div class='navbar-user d-md-none'></div>
        <!-- Collapse -->
        <div class='collapse navbar-collapse' id='sidebarCollapse'>
            <!-- Navigation -->
            <ul class='navbar-nav'>
                <li class='nav-item'>
                    <a class="nav-link" href="{{ route('admin::auctions::index') }}"><i class='fe fe-home'></i>
                        Auctions
                    </a>
                </li>
                <li class='nav-item'>
                    <a class="nav-link" href="{{ route('admin::hosts::index') }}"><i class='fe fe-home'></i>
                        Hosts
                    </a>
                </li>
                <li class='nav-item'>
                    <a class="nav-link" href="{{ route('admin::tasks::index') }}"><i class='fe fe-home'></i>
                        Tasks
                    </a>
                </li>
                <li class='nav-item'>
                    <a class="nav-link" href="{{ route('dashboard::index') }}"><i class='fe fe-home'></i>
                        User Dasboard
                    </a>
                </li>
                <li class='nav-item'>
                    <a class="nav-link" rel="nofollow" href="{{ route('logout::get') }}">
                       {{--onclick="event.preventDefault(); document.getElementById('logout-form').submit();">--}}
                        <i class='fe fe-log-out'></i>
                        Log out
                    </a>
                    {{--<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">--}}
                        {{--@csrf--}}
                    {{--</form>--}}
                </li>
            </ul>
        </div>
    </div>
</nav>
