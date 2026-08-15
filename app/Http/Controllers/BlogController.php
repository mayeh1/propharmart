<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\SiteSetting;

class BlogController extends Controller
{
    public function index()
    {
        return view('storefront.blog.index', [
            'settings' => SiteSetting::all()->pluck('value', 'key')->toArray(),
            'posts' => BlogPost::published()->latest()->paginate(9),
        ]);
    }

    public function show(BlogPost $post)
    {
        abort_unless($post->status === 'published', 404);

        return view('storefront.blog.show', [
            'settings' => SiteSetting::all()->pluck('value', 'key')->toArray(),
            'post' => $post,
            'relatedPosts' => BlogPost::published()->where('id', '!=', $post->id)->latest()->take(3)->get(),
        ]);
    }
}
