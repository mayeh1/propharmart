@extends('storefront.layout')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="mb-8 text-center">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Health tips</p>
        <h1 class="mt-2 text-4xl font-black tracking-tight text-slate-900">From the {{ $settings['site_name'] ?? 'PROPHAMART' }} blog</h1>
        <p class="mx-auto mt-3 max-w-xl text-slate-600">Wellness advice, product guides, and health tips from our team.</p>
    </div>

    @if($posts->isEmpty())
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center shadow-sm">
            <h2 class="text-xl font-bold text-slate-900">No posts yet</h2>
            <p class="mt-3 text-slate-600">Check back soon for health tips and wellness advice.</p>
        </div>
    @else
        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach($posts as $post)
                <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                    <a href="{{ route('blog.show', $post) }}">
                        <img src="{{ $post->featured_image ?? 'https://images.unsplash.com/photo-1505576399279-565b52d4ac71?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $post->title }}" class="h-52 w-full object-cover" />
                    </a>
                    <div class="p-5">
                        <div class="text-[10px] font-bold uppercase tracking-[0.18em] text-emerald-700">{{ $post->created_at->format('d M Y') }}</div>
                        <h2 class="mt-3 text-lg font-bold text-slate-900">
                            <a href="{{ route('blog.show', $post) }}" class="hover:text-emerald-700">{{ $post->title }}</a>
                        </h2>
                        @if($post->excerpt)
                            <p class="mt-2 text-sm text-slate-600">{{ $post->excerpt }}</p>
                        @endif
                        <a href="{{ route('blog.show', $post) }}" class="mt-4 inline-flex text-sm font-semibold text-emerald-700 hover:text-emerald-800">Read more →</a>
                    </div>
                </article>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $posts->links() }}
        </div>
    @endif
</div>
@endsection
