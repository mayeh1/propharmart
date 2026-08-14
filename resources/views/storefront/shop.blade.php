@extends('storefront.layout')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="mb-8 flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Catalog</p>
            <h1 class="mt-2 text-4xl font-black tracking-tight text-slate-900">Shop all products</h1>
        </div>
        <form class="flex w-full max-w-xl gap-3" method="GET" action="{{ route('shop') }}">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products" class="w-full rounded-full border border-slate-200 bg-white px-5 py-3 text-sm text-slate-700 outline-none focus:border-emerald-500" />
            <button type="submit" class="rounded-full bg-emerald-600 px-5 py-3 text-sm font-semibold text-white">Search</button>
        </form>
    </div>

    <div class="grid gap-8 lg:grid-cols-[240px_1fr]">
        <aside class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
            <h2 class="text-lg font-bold text-slate-900">Categories</h2>
            <ul class="mt-4 space-y-3 text-sm">
                @foreach($categories as $category)
                    <li>
                        <a href="{{ route('shop', ['category' => $category]) }}" class="flex items-center justify-between rounded-full px-3 py-2 text-slate-600 hover:bg-emerald-50 hover:text-emerald-700">
                            <span>{{ $category }}</span>
                            <span>›</span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </aside>

        <div>
            <div class="mb-6 flex items-center justify-between">
                <div class="text-sm text-slate-600">{{ $products->total() }} products available</div>
                <a href="{{ route('home') }}" class="text-sm font-semibold text-emerald-700">Back to homepage</a>
            </div>
            <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                @foreach($products as $product)
                    <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-lg">
                        <img src="{{ $product->image ?? 'https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $product->name }}" class="h-60 w-full object-cover" />
                        <div class="p-5">
                            <div class="text-[10px] font-bold uppercase tracking-[0.18em] text-emerald-700">{{ $product->category }}</div>
                            <h3 class="mt-3 text-xl font-bold text-slate-900">{{ $product->name }}</h3>
                            <p class="mt-2 text-sm text-slate-600">{{ $product->short_description }}</p>
                            <div class="mt-4 flex items-center justify-between text-xs font-semibold">
                                <div class="flex items-center gap-1 text-amber-400">
                                    <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                                </div>
                                @if($product->stock <= 0)
                                    <span class="text-red-600">Out of stock</span>
                                @elseif($product->stock <= 5)
                                    <span class="text-amber-600">Low stock — {{ $product->stock }} left</span>
                                @else
                                    <span class="text-emerald-600">In stock</span>
                                @endif
                            </div>
                            <div class="mt-4 flex items-center justify-between">
                                <div>
                                    <div class="text-2xl font-black text-slate-900">£{{ number_format($product->price, 2) }}</div>
                                    @if($product->compare_price)
                                        <div class="text-sm text-slate-400 line-through">£{{ number_format($product->compare_price, 2) }}</div>
                                    @endif
                                </div>
                                <div class="flex items-center gap-2">
                                    <a href="{{ route('product.show', $product) }}" class="rounded-full border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 hover:border-emerald-600 hover:text-emerald-700">Details</a>
                                    <form method="POST" action="{{ route('cart.add', $product) }}">
                                        @csrf
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" @disabled($product->stock <= 0) class="rounded-full bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-500 disabled:cursor-not-allowed disabled:bg-slate-300">Add</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
