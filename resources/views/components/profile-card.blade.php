<div class="card mb-2">
    <div class="card-header">
        <img src="{{ $user->avatar }}" alt="{{ $user->username }} avatar" class="avatar-profile">
    </div>
    <div class="card-body">
        <div>
            <h4><a href="/u/{{ $user->username }}">{{ $user->username }}</a></h4>
            @if ($user->role_id === 2)
                <div>
                    <span class="badge bg-primary">Admin</span>
                </div>
            @endif
            <p>Joined {{ $user->created_at->diffForHumans() }}</p>
            @if (Auth::check() && Auth::user()->username === $user->username)
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="profileSettingsDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-gear"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileSettingsDropdown">
                        <li><a class="dropdown-item" href="/u/{{ Auth::user()->username }}/edit">Edit Profile</a>
                        </li>
                        <li><a class="dropdown-item" href="/u/{{ Auth::user()->username }}">Account
                                Settings</a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
        <p><a href="/u/{{ $user->username }}/p"><i class="fas fa-comment"></i> Posts {{ $user->posts->count() }}
        </p></a>
        <p><a href="/u/{{ $user->username }}/p"><i class="fas fa-comments"></i> Comments
                {{ $user->comments->count() }} </p></a>

    </div>
</div>
