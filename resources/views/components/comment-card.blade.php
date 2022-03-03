<div class="d-flex">
    <div>
        <a href="/u/{{ $comment->user->username }}"><img src="{{ $comment->user->avatar }}"
                alt="{{ $comment->user->avatar }} avatar" class="rounded-circle avatar-small" /></a>
    </div>
    <div>
        <a href="/u/{{ $comment->user->username }}">{{ $comment->user->username }}</a>
        <p>posted {{ $comment->created_at->diffForHumans() }}</p>
        @if ($comment->created_at < $comment->updated_at)
            <p>edited {{ $comment->updated_at->diffForHumans() }}</p>
        @endif

        <p>{{ $comment->content }}</p>
        <div>
            <like-button :like-route-parameter="{{$comment->id}}" likeable="c"></like-button>
        </div>
    </div>
</div>
