@extends('storefront.layout')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="grid gap-10 lg:grid-cols-2">
        <div>
            <div class="overflow-hidden rounded-[2rem] border border-slate-200 bg-white p-4 shadow-sm">
                <img id="main-product-image" src="{{ $product->image ?? 'https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $product->name }}" class="h-[520px] w-full rounded-[1.6rem] object-cover" />
            </div>
            @if($product->images->count() > 1)
                <div class="mt-4 grid grid-cols-5 gap-3">
                    @foreach($product->images as $image)
                        <button type="button" onclick="document.getElementById('main-product-image').src = this.dataset.full" data-full="{{ $image->url }}" class="overflow-hidden rounded-xl border border-slate-200 hover:border-emerald-500">
                            <img src="{{ $image->url }}" alt="{{ $product->name }}" class="h-20 w-full object-cover" />
                        </button>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="py-2">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">{{ $product->category }}</p>
            <h1 class="mt-3 text-4xl font-black tracking-tight text-slate-900">{{ $product->name }}</h1>
            <div class="mt-4 flex items-center gap-4">
                <span class="text-3xl font-black text-slate-900">£{{ number_format($product->price, 2) }}</span>
                @if($product->compare_price)
                    <span class="text-lg text-slate-400 line-through">£{{ number_format($product->compare_price, 2) }}</span>
                @endif
                @if($product->stock <= 0)
                    <span class="text-sm font-semibold text-red-600">Out of stock</span>
                @elseif($product->stock <= 5)
                    <span class="text-sm font-semibold text-amber-600">Low stock — {{ $product->stock }} left</span>
                @else
                    <span class="text-sm font-semibold text-emerald-600">In stock</span>
                @endif
            </div>

            <p class="mt-6 text-slate-600">{{ $product->description }}</p>

            <form method="POST" action="{{ route('cart.add', $product) }}" class="mt-8 flex flex-wrap items-center gap-4">
                @csrf
                <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}" @disabled($product->stock <= 0) class="w-20 rounded-full border border-slate-200 px-4 py-3 text-center text-sm font-medium text-slate-700 focus:border-emerald-500 focus:outline-none" />
                <button type="submit" @disabled($product->stock <= 0) class="rounded-full bg-emerald-600 px-6 py-3 text-sm font-semibold text-white hover:bg-emerald-500 disabled:cursor-not-allowed disabled:bg-slate-300">Add to cart</button>
                <a href="{{ route('checkout.index') }}" class="rounded-full border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-700 hover:border-emerald-600 hover:text-emerald-700">Buy now</a>
            </form>

            <div class="mt-8 rounded-2xl border border-slate-200 bg-slate-50 p-5">
                <h3 class="text-sm font-semibold uppercase tracking-[0.18em] text-slate-500">Product details</h3>
                <ul class="mt-4 space-y-3 text-sm text-slate-600">
                    <li>• SKU: {{ $product->sku }}</li>
                    <li>• In stock: {{ $product->stock }} items</li>
                    <li>• Status: {{ ucfirst($product->status) }}</li>
                </ul>
            </div>
        </div>
    </div>

    <div class="mt-16">
        <h2 class="text-3xl font-black tracking-tight text-slate-900">You may also like</h2>
        <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-4">
            @foreach($relatedProducts as $related)
                <article class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
                    <img src="{{ $related->image ?? 'https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $related->name }}" class="h-52 w-full object-cover" />
                    <div class="p-5">
                        <h3 class="text-lg font-bold text-slate-900">{{ $related->name }}</h3>
                        <div class="mt-3 flex items-center justify-between">
                            <span class="text-xl font-black text-slate-900">£{{ number_format($related->price, 2) }}</span>
                            <a href="{{ route('product.show', $related) }}" class="text-sm font-semibold text-emerald-700">View</a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</div>
@endsection
