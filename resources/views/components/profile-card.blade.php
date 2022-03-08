<div class="card mb-2">
    <div class="mx-auto pt-2">
        <img src="{{ $user->avatar }}" alt="{{ $user->username }} avatar" class="avatar-profile">
    </div>
    <div class="card-body">
        <div class="text-center">
            <h4 class="mb-0"><a href="/u/{{ $user->username }}">{{ $user->username }}</a></h4>
            @if ($user->role_id === 2)
                <div>
                    <span class="badge bg-primary">Admin</span>
                </div>
            @endif
            <p class="mb-2">Joined {{ $user->created_at->diffForHumans() }}</p>
            @if (Auth::check() && Auth::user()->username === $user->username)
                <div class="mb-3">
                    <a class="btn btn-primary" href="/u/{{ Auth::user()->username }}/edit">Edit Profile</a>
                </div>
            @endif
        </div>
        <div class="d-flex align-items-center justify-content-center">
            <div class="text-center me-3">
                <p class="fs-4 fw-bold"> {{ $user->posts->count() }}</p>
                <p>POSTS</p>
            </div>
            <div class="text-center">
                <p class="fs-4 fw-bold"> {{ $user->comments->count() }}</p>
                <p>REPLIES</p>
            </div>
        </div>
    </div>
</div>
