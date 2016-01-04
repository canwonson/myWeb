<?php

namespace App\Http\Controllers;

use App\Jobs\HomeIndexData;
use App\Http\Requests;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(Request $request)
    {
        $tag = $request->get('tag');
        $data = $this->dispatch(new HomeIndexData($tag));
        $layout = $tag ? Tag::layout($tag) : 'home.layouts.index';

        return view($layout, $data);
    }

    public function showTag($tag, Request $request)
    {
        $data = $this->dispatch(new HomeIndexData($tag));
        $layout = $tag ? Tag::layout($tag) : 'home.layouts.index';
        return view($layout, $data);
    }

    public function showPost($slug, Request $request)
    {
        $post = Post::with('tags')->whereSlug($slug)->firstOrFail();
        $tag = $request->get('tag');
        if ($tag) {
            $tag = Tag::whereTag($tag)->firstOrFail();
        }

        return view($post->layout, compact('post', 'tag'));
    }
}