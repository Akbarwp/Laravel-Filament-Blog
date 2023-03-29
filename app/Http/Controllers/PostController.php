<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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

        return view('home', [
            "posts" => $posts,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
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
            ->where('published_at', '!=', null)
            ->orderBy('published_at', 'desc')
            ->paginate(7);

        return view('post.index', [
            "posts" => $posts,
            "category" => $category,
        ]);
    }
}
