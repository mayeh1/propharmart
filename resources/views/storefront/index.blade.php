@extends('storefront.layout')

@section('content')
<div class="bg-slate-100">
    <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid gap-6 lg:grid-cols-[240px_1fr]">
            <aside class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">
                <h3 class="text-lg font-black text-slate-900">Categories</h3>
                <div class="mt-4 space-y-2 text-sm font-medium text-slate-600">
                    @foreach($categories as $category)
                        <a href="{{ route('shop', ['category' => $category]) }}" class="flex items-center justify-between rounded-xl px-3 py-2 hover:bg-emerald-50 hover:text-emerald-700">
                            <span>{{ $category }}</span>
                            <span>›</span>
                        </a>
                    @endforeach
                </div>
            </aside>

            <div class="rounded-[2rem] bg-gradient-to-r from-slate-900 via-slate-800 to-emerald-900 p-8 text-white shadow-xl">
                <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
                    <div>
                        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-emerald-300">{{ $settings['welcome_message'] ?? 'Welcome to PROPHAMART' }}</p>
                        <h1 class="mt-4 text-4xl font-black tracking-tight text-white sm:text-5xl">
                            {{ $settings['hero_title'] ?? 'Trusted health products, fast delivery and secure shopping.' }}
                        </h1>
                        <p class="mt-4 max-w-xl text-slate-200">
                            {{ $settings['hero_subtitle'] ?? 'Discover premium wellness essentials and specialist healthcare support with fast, discreet delivery.' }}
                        </p>
                        <div class="mt-8 flex flex-wrap items-center gap-4">
                            <a href="{{ route('shop') }}" class="rounded-full bg-emerald-500 px-6 py-3 text-sm font-semibold text-white hover:bg-emerald-400">Shop now</a>
                            <a href="#popular" class="rounded-full border border-slate-600 bg-slate-800 px-6 py-3 text-sm font-semibold text-slate-200 hover:border-slate-500">Popular products</a>
                        </div>
                    </div>

                    <div class="rounded-[1.75rem] border border-white/10 bg-white/5 p-4 backdrop-blur-sm">
                        <div class="rounded-[1.5rem] bg-slate-950/40 p-5">
                            <div class="mb-5 flex items-center justify-between text-xs uppercase tracking-[0.16em] text-slate-300">
                                <span>Top sellers</span>
                                <span>New</span>
                            </div>
                            @foreach($featuredProducts->take(3) as $product)
                                <div class="mb-4 flex items-center gap-4 rounded-2xl border border-white/10 bg-white/5 p-3">
                                    <img src="{{ $product->image ?? 'https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $product->name }}" class="h-14 w-14 rounded-xl object-cover" />
                                    <div class="flex-1">
                                        <div class="text-sm font-semibold text-white">{{ $product->name }}</div>
                                        <div class="text-xs text-slate-300">{{ $product->category }}</div>
                                    </div>
                                    <div class="text-sm font-black text-emerald-300">£{{ number_format($product->price, 2) }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="bg-white py-5 shadow-sm">
    <div class="mx-auto grid max-w-7xl gap-4 px-4 text-sm font-medium text-slate-700 sm:grid-cols-3 sm:px-6 lg:px-8">
        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4 text-center">{{ $settings['shipping_message'] ?? 'Free shipping on all orders over £60' }}</div>
        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4 text-center">{{ $settings['dispatch_message'] ?? 'Fast UK & EU dispatch' }}</div>
        <div class="rounded-xl border border-slate-200 bg-slate-50 p-4 text-center">{{ $settings['security_message'] ?? '100% secure checkout' }}</div>
    </div>
</div>

<section id="popular" class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="mb-8 flex items-center justify-between gap-4">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Customer favourites</p>
            <h2 class="mt-2 text-3xl font-black tracking-tight text-slate-900">Best-selling products</h2>
        </div>
        <a href="{{ route('shop') }}" class="hidden text-sm font-semibold text-emerald-700 hover:text-emerald-800 sm:inline-flex">View all</a>
    </div>

    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        @foreach($featuredProducts as $product)
            <article class="product-card overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <div class="relative overflow-hidden">
                    <img src="{{ $product->image ?? 'https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $product->name }}" class="h-64 w-full object-cover" />
                    @if($product->compare_price)
                        <span class="absolute left-4 top-4 rounded-full bg-red-500 px-2.5 py-1 text-[10px] font-bold uppercase tracking-[0.12em] text-white">Save {{ number_format((($product->compare_price - $product->price) / $product->compare_price) * 100, 0) }}%</span>
                    @endif
                </div>
                <div class="p-5">
                    <div class="text-[10px] font-bold uppercase tracking-[0.18em] text-emerald-700">{{ $product->category }}</div>
                    <h3 class="mt-3 text-lg font-bold text-slate-900">{{ $product->name }}</h3>
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
                        <form method="POST" action="{{ route('cart.add', $product) }}">
                            @csrf
                            <input type="hidden" name="quantity" value="1">
                            <button type="submit" @disabled($product->stock <= 0) class="rounded-full bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-500 disabled:cursor-not-allowed disabled:bg-slate-300">Add</button>
                        </form>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>

<section id="categories" class="bg-white py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8 text-center">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Our catalog</p>
            <h2 class="mt-2 text-3xl font-black tracking-tight text-slate-900">Shop by category</h2>
        </div>
        <div class="grid gap-4 md:grid-cols-3 xl:grid-cols-6">
            @foreach($categories as $category)
                <a href="{{ route('shop', ['category' => $category]) }}" class="rounded-2xl border border-slate-200 bg-slate-50 p-6 text-center hover:border-emerald-300 hover:bg-emerald-50">
                    <div class="mx-auto mb-3 flex h-12 w-12 items-center justify-center rounded-full bg-emerald-100 text-xl text-emerald-700">✚</div>
                    <h3 class="text-base font-bold text-slate-900">{{ $category }}</h3>
                </a>
            @endforeach
        </div>
    </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="rounded-[2rem] bg-slate-900 p-8 text-white shadow-xl">
        <div class="grid gap-8 lg:grid-cols-[1.1fr_0.9fr] lg:items-center">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-300">Why choose us</p>
                <h2 class="mt-3 text-3xl font-black tracking-tight">{{ $settings['why_choose_title'] ?? 'Fast, secure and trusted pharmacy care' }}</h2>
                <p class="mt-4 max-w-xl text-slate-300">{{ $settings['why_choose_text'] ?? 'We focus on reliable product quality, discreet shipping and a smooth shopping experience for healthcare essentials.' }}</p>
            </div>
            <div class="grid gap-4 sm:grid-cols-3">
                <div class="rounded-2xl border border-slate-700 bg-slate-800 p-4 text-center"><div class="text-2xl font-black text-emerald-300">24h</div><div class="mt-2 text-sm text-slate-300">Dispatch</div></div>
                <div class="rounded-2xl border border-slate-700 bg-slate-800 p-4 text-center"><div class="text-2xl font-black text-emerald-300">EU</div><div class="mt-2 text-sm text-slate-300">Delivery</div></div>
                <div class="rounded-2xl border border-slate-700 bg-slate-800 p-4 text-center"><div class="text-2xl font-black text-emerald-300">100%</div><div class="mt-2 text-sm text-slate-300">Secure</div></div>
            </div>
        </div>
    </div>
</section>

<section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">New arrivals</p>
            <h2 class="mt-2 text-3xl font-black tracking-tight text-slate-900">Fresh in stock</h2>
        </div>
    </div>

    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-4">
        @foreach($products as $product)
            <article class="product-card overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                <img src="{{ $product->image ?? 'https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $product->name }}" class="h-56 w-full object-cover" />
                <div class="p-5">
                    <div class="text-[10px] font-bold uppercase tracking-[0.18em] text-slate-500">{{ $product->category }}</div>
                    <h3 class="mt-2 text-lg font-bold text-slate-900">{{ $product->name }}</h3>
                    <p class="mt-2 text-sm text-slate-600">{{ $product->short_description }}</p>
                    <div class="mt-4 flex items-center justify-between">
                        <span class="text-xl font-black text-slate-900">£{{ number_format($product->price, 2) }}</span>
                        <a href="{{ route('product.show', $product) }}" class="rounded-full border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-emerald-600 hover:text-emerald-700">Details</a>
                    </div>
                </div>
            </article>
        @endforeach
    </div>
</section>
@endsection
