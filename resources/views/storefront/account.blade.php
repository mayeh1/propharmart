@extends('storefront.layout')

@section('content')
<div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">
    <div class="mb-8 flex items-center justify-between">
        <div>
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">My account</p>
            <h1 class="mt-2 text-4xl font-black tracking-tight text-slate-900">{{ auth()->user()->name }}</h1>
            <p class="mt-1 text-sm text-slate-500">{{ auth()->user()->email }}</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('profile.edit') }}" class="rounded-full border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-700 hover:border-emerald-600 hover:text-emerald-700">Edit profile</a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="rounded-full border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-700 hover:border-emerald-600 hover:text-emerald-700">Log out</button>
            </form>
        </div>
    </div>

    <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
        <h2 class="text-xl font-bold text-slate-900">Order history</h2>

        @if($orders->isEmpty())
            <p class="mt-4 text-sm text-slate-600">You haven't placed any orders yet.</p>
            <a href="{{ route('shop') }}" class="mt-4 inline-flex rounded-full bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-500">Start shopping</a>
        @else
            <div class="mt-5 overflow-hidden rounded-xl border border-slate-200">
                <table class="min-w-full divide-y divide-slate-200 text-left">
                    <thead class="bg-slate-50 text-sm font-semibold text-slate-600">
                        <tr>
                            <th class="px-4 py-3">Order</th>
                            <th class="px-4 py-3">Total</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white text-sm text-slate-700">
                        @foreach($orders as $order)
                            <tr>
                                <td class="px-4 py-3 font-medium text-slate-900">{{ $order->order_number }}</td>
                                <td class="px-4 py-3">£{{ number_format($order->total, 2) }}</td>
                                <td class="px-4 py-3">
                                    <span class="rounded-full bg-amber-100 px-2.5 py-1 text-xs font-semibold uppercase tracking-[0.14em] text-amber-700">
                                        {{ $order->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3">{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>
@endsection
