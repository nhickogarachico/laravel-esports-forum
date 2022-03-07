
<div class="w-100 bg-primary py-2 px-3 mb-1">
    {{$post->created_at->format('F d, Y, g:iA')}}
</div>
<div class="d-flex post-container mb-4">
    <x-post-profile-card :user="$post->user"></x-post-profile-card>
    <div class="pt-2 px-3">
        @if ($post->created_at < $post->updated_at)
            <p>edited {{ $post->updated_at->diffForHumans() }}</p>
        @endif

        <p class="px-1">{!! nl2br($post->content) !!}</p>

        <like-button like-route-parameter="{{ $post->slug }}" :is-liked="{{ $post->likes }}" likeable="p"
            :initial-likes-count="{{ $post->likes_count }}"></like-button>
    </div>
</div>