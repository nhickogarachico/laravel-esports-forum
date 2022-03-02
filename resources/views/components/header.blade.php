<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Esports Forum</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#headerCollapse"
                aria-controls="headerCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="headerCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Discussion</a>
                    </li>
                </ul>

                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form>
                @if (Auth::check())
                    <a href="/u/{{ Auth::user()->username }}/p/new" class="btn btn-primary"><i
                            class="fas fa-plus"></i></a>
                            <img src="{{Auth::user()->avatar}}" alt="{{Auth::user()->username}} avatar" class="avatar-xs rounded-circle">
                    <div class="ms-3">

                        <div class="dropdown">
                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                id="headerUserDropdownButton" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->username }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="headerUserDropdownButton">
                                <li><a class="dropdown-item" href="/u/{{ Auth::user()->username }}">Profile</a></li>
                                <form action="/logout" method="POST">
                                    @csrf
                                    <li><button class="dropdown-item" type="submit">Logout</button></li>
                                </form>
                            </ul>
                        </div>
                    </div>
                @else
                    <a href="/register" class="btn btn-primary">Register</a>
                    <a href="/login" class="btn btn-primary">Login</a>
                @endif

            </div>
        </div>
    </nav>
</header>
