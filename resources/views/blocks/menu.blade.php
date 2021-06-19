<div class="main-content">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <nav class="navbar navbar-expand-xl navbar-light mb-2">
                    <div class="container-fluid" style="padding-left: 30px; padding-right: 30px">
                        <!-- Brand -->
                        <a class="navbar-brand" href="#!">
                            Chia Farms
                            <span class="badge badge-soft-success ml-1">BETA</span>
                        </a>
                        <!-- Toggler -->
                        <button aria-controls="navbarSupportedContent" aria-expanded="false"
                                aria-label="Toggle navigation" class="navbar-toggler collapsed"
                                data-target="#navbarSupportedContent" data-toggle="collapse" type="button">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!-- Collapse -->
                        <div class="navbar-collapse collapse" id="navbarSupportedContent" style="">
                            <!-- Nav -->
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item active">
                                    <a class="nav-link active" href="/">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('speedtest::index')}}">Speedtest</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('faq::index')}}">FAQ</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('blogs::index')}}">About</a>
                                </li>
                                <!-- Authentication Links -->
                                @guest
                                    @if (Route::has('register'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('register') }}">{{ __('Sign up') }}</a>
                                        </li>
                                    @endif
                                    @if (Route::has('login'))
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ route('login') }}">{{ __('Sign in') }}</a>
                                        </li>
                                    @endif
                                @else
                                    <li class="nav-item">
                                        <a class="nav-link" href="/dashboard">Dashboard</a>
                                    </li>
                                @endguest
                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</div>

<ul class="navbar-nav ml-auto">
</ul>
