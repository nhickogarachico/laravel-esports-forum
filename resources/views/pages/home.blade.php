@extends('layouts.main')

@section('content')
    <div>
        <h1>Welcome to Esports Forum!</h1>
        <p>Online community for people who like everything esports. From League of Legend to CS:GO, you can meet and
            socialize with people that play your game and watch your favorite teams.</p>
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <ul class="list-group">

                            <li class="list-group-item"><a href="news">News</a> </li>
                            <li class="list-group-item"><a href="match-discussion">Match Discussion</a></li>
                            <li class="list-group-item">
                                <ul class="list-group">
                                    <p>Esports</p>
                                    <li class="list-group-item"><a href="cs-go">CS:GO</a></li>
                                    <li class="list-group-item"><a href="dota-2">Dota 2</a></li>
                                    <li class="list-group-item"><a href="league-of-legends">League of Legends</a></li>
                                    <li class="list-group-item"><a href="valorant">Valorant</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col">
                <h2>Recent Posts</h2>
                <div class="d-flex">
                    <div>
                        <a href="/{{Route::input('tag')}}"><span class="badge bg-secondary">Latest Posts</span> </a>
                    </div>
                    <div>
                        <a href="?sort=top"><span class="badge bg-secondary">Top Posts</span> </a>
                    </div>
                    <div>
                        <a href="?sort=replies"><span class="badge bg-secondary">Most Replies</span> </a>
                    </div>
                </div>
                @foreach ($posts as $post)
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex">
                                <img src="{{ $post->user->avatar }}" alt="{{ $post->user->username }} avatar"
                                    class="avatar-xs rounded-circle">
                                <div>
                                    <h4 class="mb-1"><a href="/p/{{ $post->slug }}">{{ $post->title }}</a>
                                    </h4>
                                    <p class="mb-1"><a
                                            href="/u/{{ $post->user->username }}">{{ $post->user->username }}</a></p>
                                    <p>{{ $post->created_at->diffForHumans() }}</p>
                                    <p><i class="fas fa-thumbs-up"></i>{{ $post->likes()->count() }}</p>
                                    <p><i class="fas fa-comments"></i>{{ $post->comments()->count() }}</p>
                                </div>
                                <div>
                                    @foreach ($post->tags as $tag)
                                        <span class="badge bg-primary">{{ $tag->tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
