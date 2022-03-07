<header>
    <nav class="navbar navbar-expand-md fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Esports Forum</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#headerCollapse"
                aria-controls="headerCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fas fa-bars text-white "></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="headerCollapse">
                <form action="/search" method="GET" class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="q" />
                    <button class="btn btn-no-bg" type="submit"><i class="fas fa-search"></i></button>
                </form>
                @if (Auth::check())
                    <div class="header-collapse-main d-flex align-items-center">
                        <a href="/u/{{ Auth::user()->username }}/p/new" class="btn btn-no-bg me-2"><i
                                class="fas fa-plus"></i></a>
                        <a href="/u/{{ Auth::user()->username }}">
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->username }} avatar"
                                class="avatar-xs rounded-circle">
                        </a>
                        <div class="ms-2">
                            <div class="dropdown">
                                <button class="btn btn-no-bg dropdown-toggle" type="button"
                                    id="headerUserDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ Auth::user()->username }}
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="headerUserDropdownButton">
                                    <li><a class="dropdown-item" href="/u/{{ Auth::user()->username }}">Profile</a>
                                    </li>
                                    <form action="/logout" method="POST">
                                        @csrf
                                        <li><button class="dropdown-item" type="submit">Logout</button></li>
                                    </form>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="header-collapse-dropdown mt-2">
                        <a href="/u/{{ Auth::user()->username }}/p/new" class="btn btn-no-bg">New Post</a>
                        <a href="/u/{{ Auth::user()->username }}" class="btn btn-no-bg">Profile</a>
                        <form action="/logout" method="POST">
                            @csrf
                           <button class="btn btn-no-bg w-100" type="submit">Logout</button>
                        </form>
                    </div>
                @else
                    <div class="d-flex login-buttons">
                        <a href="/register" class="btn btn-no-bg d-block">Register</a>
                        <a href="/login" class="btn btn-no-bg d-block">Login</a>
                    </div>
                @endif

            </div>
        </div>
    </nav>
</header>
