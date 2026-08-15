<x-app-layout>
<div class="py-12">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Blog</p>
                <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900">{{ isset($post->id) ? 'Edit post' : 'Write a post' }}</h1>
            </div>
            <a href="{{ route('admin.blog.index') }}" class="text-sm font-semibold text-slate-700 hover:text-emerald-700">Back to posts</a>
        </div>

        <form method="POST" action="{{ isset($post->id) ? route('admin.blog.update', $post) : route('admin.blog.store') }}" enctype="multipart/form-data" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            @csrf
            @if(isset($post->id))
                @method('PUT')
            @endif

            <div class="grid gap-6">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Title</label>
                    <input type="text" name="title" value="{{ old('title', $post->title ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none" required>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Excerpt</label>
                    <input type="text" name="excerpt" value="{{ old('excerpt', $post->excerpt ?? '') }}" placeholder="A short summary shown on the blog listing page" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Post content</label>
                    <textarea name="body" rows="14" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none" required>{{ old('body', $post->body ?? '') }}</textarea>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Featured image</label>
                    @if(!empty($post->featured_image))
                        <img src="{{ $post->featured_image }}" alt="Current featured image" class="mb-2 h-24 w-24 rounded-xl border border-slate-200 object-cover">
                    @endif
                    <input type="file" name="featured_image" accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-emerald-500 focus:outline-none">
                    <p class="mt-1 text-xs text-slate-500">JPG, PNG or WebP, up to 4MB.@if(!empty($post->featured_image)) Leave empty to keep the current image.@endif</p>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Status</label>
                    <select name="status" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">
                        <option value="draft" {{ old('status', $post->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $post->status ?? 'draft') === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <a href="{{ route('admin.blog.index') }}" class="rounded-full border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-700">Cancel</a>
                <button type="submit" class="rounded-full bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-500">{{ isset($post->id) ? 'Update post' : 'Publish post' }}</button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
