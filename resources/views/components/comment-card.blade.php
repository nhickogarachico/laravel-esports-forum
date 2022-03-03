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

        {{-- reply to --}}
        @if ($comment->parent_id)
            <div>
                <p>{{$comment->parentComment->user->username}}</p>
                <p>{{$comment->parentComment->content}}</p>
            </div>
        @endif
        <p>{{ $comment->content }}</p>
        <div>
            <like-button :like-route-parameter="{{$comment->id}}" likeable="c" :initial-likes-count={{$comment->likes_count}}></like-button>
            <a href="/c/{{$comment->id}}/reply" class="btn btn-secondary">Reply</a>
        </div>
    </div>
</div>
