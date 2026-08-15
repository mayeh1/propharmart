@extends('storefront.layout')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-12 sm:px-6 lg:px-8">
    <a href="{{ route('blog.index') }}" class="text-sm font-semibold text-emerald-700 hover:text-emerald-800">← Back to blog</a>

    <p class="mt-6 text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">{{ $post->created_at->format('d M Y') }}</p>
    <h1 class="mt-3 text-4xl font-black tracking-tight text-slate-900">{{ $post->title }}</h1>

    @if($post->featured_image)
        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="mt-8 h-[360px] w-full rounded-[2rem] object-cover" />
    @endif

    <div class="mt-8 whitespace-pre-line text-base leading-relaxed text-slate-700">
        {{ $post->body }}
    </div>

    @if($relatedPosts->isNotEmpty())
        <div class="mt-16 border-t border-slate-200 pt-10">
            <h2 class="text-2xl font-black tracking-tight text-slate-900">More health tips</h2>
            <div class="mt-6 grid gap-6 sm:grid-cols-3">
                @foreach($relatedPosts as $related)
                    <a href="{{ route('blog.show', $related) }}" class="group">
                        <img src="{{ $related->featured_image ?? 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $related->title }}" class="h-32 w-full rounded-xl object-cover" />
                        <div class="mt-3 text-sm font-bold text-slate-900 group-hover:text-emerald-700">{{ $related->title }}</div>
                    </a>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
