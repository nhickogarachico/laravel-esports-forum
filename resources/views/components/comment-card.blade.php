<div class="w-100 bg-primary py-2 px-3 mb-1">
    {{ $comment->created_at->format('F d, Y, g:iA') }}
</div>

{{-- <div class="d-flex post-container mb-4">
    <x-post-profile-card :user="$comment->user"></x-post-profile-card>
    <div class="pt-2 px-3">
        @if ($comment->created_at < $comment->updated_at)
            <p>edited {{ $comment->updated_at->diffForHumans() }}</p>
        @endif

        <div class="post-content">
            @if ($comment->parent_id)
                <div class="mb-3">
                    <p class="px-3 py-1"><a
                            href="/u/{{ $comment->parentComment->user->username }}">{{ $comment->parentComment->user->username }}</a>
                        said:</p>
                    <div class="post-reply p-3">
                        <p>{{ $comment->parentComment->content }}</p>
                    </div>
                </div>
            @endif

            <p class="px-1">{!! nl2br($comment->content) !!}</p>
        </div>
        <div class="d-flex align-items-center">
            <div>
                <like-button :like-route-parameter="{{ $comment->id }}" likeable="c"
                    :initial-likes-count={{ $comment->likes_count }}></like-button>
            </div>
            <div>
                <a href="/c/{{ $comment->id }}/reply" class="btn"><i class="fas fa-comment"></i>
                    Reply</a>
            </div>

        </div>
    </div>
</div> --}}

<div class="mb-4 row">
    <div class="col-md-3 col-lg-2">
        <x-post-profile-card :user="$comment->user"></x-post-profile-card>
    </div>
    <div class="col">
        <div class="pt-2">
            @if ($comment->created_at < $comment->updated_at)
                <p>edited {{ $comment->updated_at->diffForHumans() }}</p>
            @endif

            {{-- reply to --}}
            <div class="post-content">
                @if ($comment->parent_id)
                    <div class="mb-3">
                        <p class="px-3 py-1"><a
                                href="/u/{{ $comment->parentComment->user->username }}">{{ $comment->parentComment->user->username }}</a>
                            said:</p>
                        <div class="post-reply p-3">
                            <p>{{ $comment->parentComment->content }}</p>
                        </div>
                    </div>
                @endif

                <p>{!! nl2br($comment->content) !!}</p>
            </div>
            <div class="d-flex align-items-center">
                <div>
                    <like-button :like-route-parameter="{{ $comment->id }}" likeable="c"
                        :initial-likes-count={{ $comment->likes_count }}></like-button>
                </div>
                <div>
                    <a href="/c/{{ $comment->id }}/reply" class="btn"><i class="fas fa-comment"></i>
                        Reply</a>
                </div>

            </div>
        </div>
    </div>
</div>
