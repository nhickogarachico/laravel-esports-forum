<div class="px-3 py-2 text-center post-profile-card">
    <a href="/u/{{ $user->username }}" class="mb-2 d-block"><img src="{{ $user->avatar }}"
            alt="{{ $user->avatar }} avatar" class="rounded-circle avatar-small" /></a>
    <div class="profile-info">
        <a href="/u/{{ $user->username }}" class="d-block">{{ $user->username }}</a>
        @if ($user->role_id === 2)
            <div>
                <span class="badge bg-primary">Admin</span>
            </div>
        @endif
    </div>
    <div class="profile-card-data mt-3">
        <div class="d-flex align-items-center justify-content-between mb-2">
            <p> <i class="fas fa-calendar"></i></p>
            <p>{{ $user->created_at->format('F d, Y') }}</p>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-2">
            <p> <i class="fas fa-comment"></i></p>
            <p>{{ $user->posts->count() }} posts</p>
        </div>
        <div class="d-flex align-items-center justify-content-between mb-2">
            <p> <i class="fas fa-comments"></i></p>
            <p>{{ $user->comments->count() }} replies</p>
        </div>
    </div>
</div>
