<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use App\Models\TagCategory;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $tag;
    protected $post;
    protected $user;
    protected $tagCategory;

    public function __construct(Tag $tag, Post $post, User $user, TagCategory $tagCategory)
    {
        $this->tag = $tag;
        $this->post = $post;
        $this->user = $user;
        $this->tagCategory = $tagCategory;
    }

    public function showHomeView(Request $request)
    {
        // if ($tag) {
        //     $tag = $this->tag->where('query_tag', $tag)->first();
        //     if ($tag) {
        //         switch ($request->query('sort')) {
        //             case 'top':
        //                 $posts = $tag->topPosts();
        //                 break;
        //             case 'replies':
        //                 $posts =  $tag->mostReplies();
        //                 break;
        //             default:
        //                 $posts = $tag->posts;
        //                 break;
        //         }
        //     } else {
        //         return redirect('/');
        //     }
        // } else {
        //     /**If there is no tag in the url */
        //     switch ($request->query('sort')) {
        //         case 'top':
        //             $posts = $this->post->topPosts();
        //             break;
        //         case 'replies':
        //             $posts = $this->post->mostReplies();
        //             break;
        //         default:
        //             $posts = $this->post->orderBy('created_at', 'DESC')->get();
        //             break;
        //     }
        // }

        if ($request->query('category')) {
            return view('pages.tag-results');
        } else {
            return view('pages.home', [
                'tag' => $this->tag,
                'tagCategory' => $this->tagCategory,
                'posts' => $this->post->all(),
                'users' => $this->user->orderBy('created_at', 'DESC')->get()
            ]);
        }
    }

    public function showTagCategoriesView(Request $request, $queryCategory, $queryTag = "")
    {
        $tagCategory = $this->tagCategory->where('query_string', $queryCategory)->first();
        $tag = $this->tag->where('query_tag', $queryTag)->first();
        if ($tagCategory) {
            if ($tag) {
                if($request->query('pageNumber') > $tag->posts->count())
                {
                    return redirect("/$tagCategory->query_string/$tag->query_tag");
                }

                return view('pages.tag-posts',[
                    'tag' => $tag,
                    'perPage' => 10,
                    'pageNumber' => $request->query('pageNumber') ? $request->query('pageNumber') : 1
                ]);
            } else {
                $tags = $this->tag->tagsByCategory($tagCategory->id);
                return view('pages.tag-categories', [
                    'tagCategory' => $tagCategory,
                    'tags' => $tags
                ]);
            }
        } else {
            return redirect('/');
        }
    }
}
