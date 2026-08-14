@extends('storefront.layout')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Checkout</p>
        <h1 class="mt-2 text-4xl font-black tracking-tight text-slate-900">Complete your order</h1>
    </div>

    <div class="grid gap-8 lg:grid-cols-[1.15fr_0.85fr]">
        <form method="POST" action="{{ route('checkout.store') }}" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            @csrf

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Full name</label>
                    <input type="text" name="customer_name" required class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none" />
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Email address</label>
                    <input type="email" name="customer_email" required class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none" />
                </div>
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Phone</label>
                    <input type="text" name="customer_phone" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none" />
                </div>
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Shipping address</label>
                    <textarea name="shipping_address" required rows="4" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none"></textarea>
                </div>
            </div>

            <div class="mt-8 flex items-center justify-between">
                <a href="{{ route('cart.index') }}" class="text-sm font-semibold text-emerald-700">Back to cart</a>
                <button type="submit" class="rounded-full bg-emerald-600 px-6 py-3 text-sm font-semibold text-white hover:bg-emerald-500">Place order</button>
            </div>
        </form>

        <aside class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <h2 class="text-xl font-bold text-slate-900">Your order</h2>
            <div class="mt-5 space-y-4">
                @foreach($items as $item)
                    <div class="flex items-center justify-between gap-4 border-b border-slate-200 pb-4">
                        <div>
                            <div class="font-semibold text-slate-900">{{ $item['name'] }}</div>
                            <div class="text-sm text-slate-500">Qty: {{ $item['quantity'] }}</div>
                        </div>
                        <div class="font-bold text-slate-900">£{{ number_format(($item['price'] * $item['quantity']), 2) }}</div>
                    </div>
                @endforeach
            </div>

            <div class="mt-6 space-y-3 text-sm text-slate-600">
                <div class="flex justify-between"><span>Subtotal</span><span>£{{ number_format($subtotal, 2) }}</span></div>
                <div class="flex justify-between"><span>Shipping</span><span>{{ $shipping == 0 ? 'Free' : '£' . number_format($shipping, 2) }}</span></div>
                <div class="flex justify-between border-t border-slate-200 pt-4 text-base font-bold text-slate-900"><span>Total</span><span>£{{ number_format($total, 2) }}</span></div>
            </div>
        </aside>
    </div>
</div>
@endsection
