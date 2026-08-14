@extends('storefront.layout')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Cart</p>
            <h1 class="mt-2 text-4xl font-black tracking-tight text-slate-900">Your basket</h1>
        </div>
        <a href="{{ route('shop') }}" class="text-sm font-semibold text-emerald-700">Continue shopping</a>
    </div>

    @if(empty($items))
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white p-12 text-center shadow-sm">
            <h2 class="text-2xl font-bold text-slate-900">Your cart is empty</h2>
            <p class="mt-3 text-slate-600">Add a few wellness essentials to get started.</p>
            <a href="{{ route('shop') }}" class="mt-6 inline-flex rounded-full bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-500">Shop products</a>
        </div>
    @else
        <div class="grid gap-8 lg:grid-cols-[1.4fr_0.6fr]">
            <div class="space-y-5">
                @foreach($items as $item)
                    <div class="flex flex-col gap-5 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm sm:flex-row sm:items-center">
                        <img src="{{ $item['image'] ?? 'https://images.unsplash.com/photo-1571781926291-c477ebfd024b?auto=format&fit=crop&w=900&q=80' }}" alt="{{ $item['name'] }}" class="h-28 w-28 rounded-2xl object-cover" />
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-slate-900">{{ $item['name'] }}</h3>
                            <p class="mt-1 text-sm text-slate-500">£{{ number_format($item['price'], 2) }} each</p>
                        </div>
                        <form method="POST" action="{{ route('cart.update', ['product' => $item['product_id']]) }}" class="flex items-center gap-3">
                            @csrf
                            <label class="text-sm font-medium text-slate-600">Qty</label>
                            <input type="number" name="quantity" value="{{ $item['quantity'] }}" min="1" class="w-20 rounded-xl border border-slate-200 px-3 py-2 text-center text-sm focus:border-emerald-500 focus:outline-none" />
                            <button type="submit" class="rounded-full border border-slate-200 px-3 py-2 text-sm font-semibold text-slate-700 hover:border-emerald-600 hover:text-emerald-700">Update</button>
                        </form>
                        <div class="text-right">
                            <div class="text-lg font-black text-slate-900">£{{ number_format(($item['price'] * $item['quantity']), 2) }}</div>
                            <form method="POST" action="{{ route('cart.remove', ['product' => $item['product_id']]) }}">
                                @csrf
                                <button type="submit" class="mt-2 text-sm font-semibold text-red-600">Remove</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <aside class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900">Order summary</h2>
                <div class="mt-6 space-y-4 text-sm text-slate-600">
                    <div class="flex justify-between">
                        <span>Subtotal</span>
                        <span>£{{ number_format($total, 2) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Shipping</span>
                        <span>{{ $total > 60 ? 'Free' : '£6.99' }}</span>
                    </div>
                    <div class="flex justify-between border-t border-slate-200 pt-4 text-base font-bold text-slate-900">
                        <span>Total</span>
                        <span>£{{ number_format($total > 60 ? $total : $total + 6.99, 2) }}</span>
                    </div>
                </div>
                <a href="{{ route('checkout.index') }}" class="mt-6 block rounded-full bg-emerald-600 px-5 py-3 text-center text-sm font-semibold text-white hover:bg-emerald-500">Proceed to checkout</a>
            </aside>
        </div>
    @endif
</div>
@endsection
