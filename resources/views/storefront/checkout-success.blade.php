@extends('storefront.layout')

@section('content')
<div class="mx-auto max-w-3xl px-4 py-16 sm:px-6 lg:px-8">
    <div class="rounded-[2rem] border border-emerald-200 bg-white p-10 text-center shadow-sm">
        <div class="mx-auto mb-6 flex h-16 w-16 items-center justify-center rounded-full bg-emerald-100 text-3xl">✓</div>
        <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Order confirmed</p>
        <h1 class="mt-3 text-4xl font-black tracking-tight text-slate-900">Thank you for shopping with PROPHAMART</h1>
        <p class="mt-4 text-slate-600">Your order <span class="font-bold text-slate-900">{{ $order->order_number }}</span> has been placed and is now being processed.</p>

        <div class="mt-8 rounded-2xl bg-slate-50 p-6 text-left">
            <div class="flex justify-between text-sm text-slate-600"><span>Customer</span><span class="font-medium text-slate-900">{{ $order->customer_name }}</span></div>
            <div class="mt-3 flex justify-between text-sm text-slate-600"><span>Total</span><span class="font-bold text-slate-900">£{{ number_format($order->total, 2) }}</span></div>
        </div>

        <div class="mt-8 flex justify-center gap-4">
            <a href="{{ route('shop') }}" class="rounded-full bg-emerald-600 px-6 py-3 text-sm font-semibold text-white hover:bg-emerald-500">Continue shopping</a>
            <a href="{{ route('home') }}" class="rounded-full border border-slate-200 px-6 py-3 text-sm font-semibold text-slate-700 hover:border-emerald-600 hover:text-emerald-700">Back home</a>
        </div>
    </div>
</div>
@endsection
