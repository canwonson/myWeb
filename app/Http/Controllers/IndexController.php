<?php

namespace App\Http\Controllers;

use App\Post;
use Carbon\Carbon;

class IndexController extends Controller
{
    public function index()
    {
        $posts = Post::where('published_at', '<=', Carbon::now())
                ->orderBy('published_at', 'desc')
                ->paginate(config('home.posts_per_page'));

        return view('home.index', compact('posts'));
    }

    public function showPost($slug)
    {
        $post = Post::whereSlug($slug)->firstOrFail();
        return view('home.post')->withPost($post);
    }
}