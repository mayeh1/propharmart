<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BlogPostController extends Controller
{
    public function index()
    {
        $posts = BlogPost::latest()->paginate(12);

        return view('admin.blog.index', compact('posts'));
    }

    public function create()
    {
        return view('admin.blog.form', ['post' => new BlogPost()]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:255',
            'body' => 'required|string',
            'featured_image' => 'nullable|image|max:4096',
            'status' => 'required|in:draft,published',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $this->storeImage($request->file('featured_image'));
        } else {
            unset($validated['featured_image']);
        }

        BlogPost::create($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Post created successfully.');
    }

    public function edit(BlogPost $post)
    {
        return view('admin.blog.form', compact('post'));
    }

    public function update(Request $request, BlogPost $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'nullable|string|max:255',
            'body' => 'required|string',
            'featured_image' => 'nullable|image|max:4096',
            'status' => 'required|in:draft,published',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        if ($request->hasFile('featured_image')) {
            $this->deleteImage($post->featured_image);
            $validated['featured_image'] = $this->storeImage($request->file('featured_image'));
        } else {
            unset($validated['featured_image']);
        }

        $post->update($validated);

        return redirect()->route('admin.blog.index')->with('success', 'Post updated successfully.');
    }

    public function destroy(BlogPost $post)
    {
        $this->deleteImage($post->featured_image);
        $post->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Post deleted successfully.');
    }

    protected function storeImage($file)
    {
        return Storage::disk('public')->url($file->store('blog', 'public'));
    }

    protected function deleteImage(?string $url)
    {
        if (! $url || ! str_starts_with($url, Storage::disk('public')->url(''))) {
            return;
        }

        $path = ltrim(Str::after($url, Storage::disk('public')->url('')), '/');
        Storage::disk('public')->delete($path);
    }
}
