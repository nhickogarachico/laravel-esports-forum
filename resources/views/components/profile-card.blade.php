<div class="card mb-2">
    <div class="card-header">
        <img src="/images/default_profile.png" alt="{{ $user->username }} avatar">
    </div>
    <div class="card-body">
        <div>
            <h4>{{ $user->username }}</h4>
            @if (Auth::check() && Auth::user()->username === $user->username)
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="profileSettingsDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-gear"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileSettingsDropdown">
                        <li><a class="dropdown-item" href="/u/{{ Auth::user()->username }}">Edit Profile</a>
                        </li>
                        <li><a class="dropdown-item" href="/u/{{ Auth::user()->username }}">Account
                                Settings</a>
                        </li>
                    </ul>
                </div>
            @endif
        </div>
        <p><i class="fas fa-comment"></i> <a href="/u/{{$user->username}}/p"> Posts {{count($user->posts)}} </a></p>
        <p><i class="fas fa-comments"></i> Comments 15</p>
    
    </div>
</div>