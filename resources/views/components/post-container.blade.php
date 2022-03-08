<div class="w-100 bg-primary py-2 px-3 mb-1">
    {{ $post->created_at->format('F d, Y, g:iA') }}
</div>
{{-- <div class="d-flex post-container mb-4 justify-content-between">
    <x-post-profile-card :user="$post->user"></x-post-profile-card>
    <div class="pt-2 px-3 w-100">
        @if ($post->created_at < $post->updated_at)
            <p>edited {{ $post->updated_at->diffForHumans() }}</p>
        @endif
        <div class="post-content">
            <p class="px-1">{!! nl2br($post->content) !!}</p>
        </div>
        <like-button like-route-parameter="{{ $post->slug }}" :is-liked="{{ $post->likes }}" likeable="p"
            :initial-likes-count="{{ $post->likes_count }}"></like-button>
    </div>
</div> --}}
<div class="mb-4 row">
    <div class="col-md-3 col-lg-2">
        <x-post-profile-card :user="$post->user"></x-post-profile-card>
    </div>
    <div class="col">
        <div class="pt-2 w-100">
            @if ($post->created_at < $post->updated_at)
                <p>edited {{ $post->updated_at->diffForHumans() }}</p>
            @endif
            <div class="post-content">
                <p>{!! nl2br($post->content) !!}</p>
            </div>
            <like-button like-route-parameter="{{ $post->slug }}" :is-liked="{{ $post->likes }}" likeable="p"
                :initial-likes-count="{{ $post->likes_count }}"></like-button>
        </div>
    </div>
</div>
