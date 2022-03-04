<?php

namespace App\Http\Controllers\Search;

use App\Http\Controllers\Controller;
use App\Http\Requests\Search\SearchRequest;
use App\Models\Post;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    protected $post;

    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    public function showSearchResults(Request $request)
    {

        switch ($request->sort) {
            case 'top':
                $posts = $this->post
                    ->where('title', 'LIKE', '%' . $request->q . '%')
                    ->where('content', 'LIKE',  '%' . $request->q . '%')
                    ->withCount('likes')
                    ->orderBy('likes_count', 'DESC')
                    ->get();
                break;
            case 'replies':
                $posts = $this->post
                    ->where('title', 'LIKE', '%' . $request->q . '%')
                    ->where('content', 'LIKE',  '%' . $request->q . '%')
                    ->withCount('comments')
                    ->orderBy('comments_count', 'DESC')
                    ->get();
                break;
            default:
                $posts = $this->post
                    ->where('title', 'LIKE', '%' . $request->q . '%')
                    ->where('content', 'LIKE',  '%' . $request->q . '%')
                    ->orderBy('created_at', 'DESC')
                    ->get();
                break;
        }
        return view('pages.search-result', [
            'posts' => $posts,
            'query' => $request->q

        ]);
    }
}
