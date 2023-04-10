<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\PostShow;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::where('active', '=', true)
        ->where('published_at', '!=', null)
        ->orderBy('published_at', 'desc')
        ->paginate(7);

        return view('showAll', [
            "posts" => $posts,
        ]);
    }

    public function home()
    {
        //? Latest Post
        $latestPost = Post::where('active', '=', 1)
            ->where('published_at', '<', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->limit(1)->first();

        //? Popular Post
        $popularPost = Post::leftJoin('up_down_votes as vote', 'vote.post_id', '=', 'posts.id')
            ->select('posts.*', DB::raw('COUNT(vote.id) as upvote_count'))
            ->where(function ($query) {
                $query->whereNull('vote.is_upvote')->orWhere('vote.is_upvote', '=', 1);
            })
            ->where('active', '=', 1)
            ->where('published_at', '<', Carbon::now())
            ->groupBy([
                'posts.id',
                'posts.title',
                'posts.slug',
                'posts.thumbnail',
                'posts.body',
                'posts.active',
                'posts.published_at',
                'posts.user_id',
                'posts.created_at',
                'posts.updated_at',
                'posts.meta_title',
                'posts.meta_description',
            ])
            ->orderBy('upvote_count', 'desc')
            ->limit(5)->get();
        
        //? Recommended Posts
        $user = auth()->user();

        // If authorized
        if ($user) {
            $leftJoin = "(SELECT cp.category_id, cp.post_id FROM up_down_votes as vote JOIN category_post as cp ON vote.post_id = cp.post_id WHERE vote.is_upvote = 1 AND vote.user_id = ?) as t";

            $recommendedPost = Post::leftJoin('category_post as cp', 'posts.id', '=', 'cp.post_id')
                ->leftJoin(DB::raw($leftJoin), function ($join) {
                    $join->on('t.category_id', '=', 'cp.category_id')
                        ->on('t.post_id', '<>', 'cp.post_id');
                })
                ->select('posts.*')
                ->where('posts.id', '<>', DB::raw('t.post_id'))
                ->setBindings([$user->id])->limit(3)->get();

        // If not authorized
        } else {
            $recommendedPost = Post::leftJoin('post_shows as view', 'view.post_id', '=', 'posts.id')
            ->select('posts.*', DB::raw('COUNT(view.id) as view_count'))
            ->where('active', '=', 1)
            ->where('published_at', '<', Carbon::now())
            ->groupBy([
                'posts.id',
                'posts.title',
                'posts.slug',
                'posts.thumbnail',
                'posts.body',
                'posts.active',
                'posts.published_at',
                'posts.user_id',
                'posts.created_at',
                'posts.updated_at',
                'posts.meta_title',
                'posts.meta_description',
            ])
            ->orderBy('view_count', 'desc')
            ->limit(3)->get();
        }

        //? Recent Category
        $categories = Category::query()
            // ->with(['posts' => function ($query) {
            //     $query->orderByDesc('published_at');
            // }])
            ->whereHas('posts', function ($query) {
                $query
                    ->where('active', '=', 1)
                    ->whereDate('published_at', '<', Carbon::now());
            })
            ->select('categories.*')
            ->selectRaw('MAX(posts.published_at) as max_date')
            ->leftJoin('category_post', 'categories.id', '=', 'category_post.category_id')
            ->leftJoin('posts', 'posts.id', '=', 'category_post.post_id')
            ->orderByDesc('max_date')
            ->groupBy([
                'categories.id',
                'categories.title',
                'categories.slug',
                'categories.created_at',
                'categories.updated_at',
            ])
            ->limit(5)->get();


        return view('home', [
            "latestPost" => $latestPost,
            "popularPost" => $popularPost,
            "recommendedPost" => $recommendedPost,
            "categories" => $categories,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post, Request $request)
    {
        if (!$post->active || $post->published_at > Carbon::now()) {
            throw new NotFoundHttpException();
        }

        $next = Post::where('active', true)
        ->where('published_at', '<=', Carbon::now())
        ->where('published_at', '<', $post->published_at)
        ->orderBy('published_at', 'desc')
        ->limit(1)->first();

        $previous = Post::where('active', true)
        ->where('published_at', '<=', Carbon::now())
        ->where('published_at', '>', $post->published_at)
        ->orderBy('published_at', 'asc')
        ->limit(1)->first();

        $user = $request->user();

        PostShow::create([
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'post_id' => $post->id,
            'user_id' => $user?->id
        ]);

        return view('post.show', [
            "post" => $post,
            "next" => $next,
            "previous" => $previous
        ]);
    }

    public function byCategory(Category $category)
    {
        $posts = Post::join('category_post as cp', 'cp.post_id', '=', 'posts.id')
            ->where('cp.category_id', '=', $category->id)
            ->where('active', '=', true)
            ->where('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->paginate(7);

        return view('post.index', [
            "posts" => $posts,
            "category" => $category,
        ]);
    }

    public function search(Request $request)
    {
        $q = $request->get('q');

        $posts = Post::query()
            ->where('active', '=', true)
            ->whereDate('published_at', '<=', Carbon::now())
            ->orderBy('published_at', 'desc')
            ->where(function ($query) use ($q) {
                $query->where('title', 'like', "%$q%")
                    ->orWhere('body', 'like', "%$q%");
            })
            ->paginate(10);

        return view('post.search', compact('posts'));
    }
}
