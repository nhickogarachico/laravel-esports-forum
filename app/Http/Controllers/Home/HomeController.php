<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $tag;
    protected $post;

    public function __construct(Tag $tag, Post $post)
    {
        $this->tag = $tag;
        $this->post = $post;
    }

    public function showHomeView(Request $request, $tag = "")
    {

        if ($tag) {
            $tag = $this->tag->where('query_tag', $tag)->first();
            if ($tag) {
                switch ($request->query('sort')) {
                    case 'top':
                        $posts = $tag->posts()->withCount('likes')->orderBy('likes_count', 'DESC')->get();
                        break;
                    case 'replies':
                        $posts =  $tag->posts()->withCount('comments')->orderBy('comments_count', 'DESC')->get();
                        break;
                    default:
                        $posts = $tag->posts;
                        break;
                }
            } else {
                return redirect('/');
            }
        } else {
            /**If there is no tag in the url */
            switch ($request->query('sort')) {
                case 'top':
                    $posts = $this->post->topPosts();
                    break;
                case 'replies':
                    $posts = $this->post->mostReplies();
                    break;
                default:
                    $posts = $this->post->orderBy('created_at', 'DESC')->get();
                    break;
            }
        }



        return view('pages.home', [
            'tags' => $this->tag->all(),
            'posts' => $posts
        ]);

        // $tag =  $this->tag->where('query_tag', $tag)->first();

        // return response()->json([
        //     'tags' => $tag->posts->withCount('likes')->get()
        // ]);
    }
}
