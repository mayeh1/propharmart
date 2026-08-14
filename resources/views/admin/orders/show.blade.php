<x-app-layout>
<div class="py-12">
    <div class="mx-auto max-w-5xl px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Order</p>
                <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900">{{ $order->order_number }}</h1>
            </div>
            <a href="{{ route('admin.orders.index') }}" class="text-sm font-semibold text-emerald-700">Back to orders</a>
        </div>

        <div class="grid gap-8 lg:grid-cols-[1fr_0.8fr]">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900">Items</h2>
                <div class="mt-5 space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex items-center justify-between border-b border-slate-200 pb-4">
                            <div>
                                <div class="font-semibold text-slate-900">{{ $item->product_name }}</div>
                                <div class="text-sm text-slate-500">Qty: {{ $item->quantity }}</div>
                            </div>
                            <div class="font-bold text-slate-900">£{{ number_format($item->total, 2) }}</div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h2 class="text-xl font-bold text-slate-900">Details</h2>
                <dl class="mt-5 space-y-3 text-sm text-slate-600">
                    <div class="flex justify-between"><dt>Customer</dt><dd class="font-medium text-slate-900">{{ $order->customer_name }}</dd></div>
                    <div class="flex justify-between"><dt>Email</dt><dd class="font-medium text-slate-900">{{ $order->customer_email }}</dd></div>
                    <div class="flex justify-between"><dt>Phone</dt><dd class="font-medium text-slate-900">{{ $order->customer_phone ?? '—' }}</dd></div>
                    <div class="flex justify-between"><dt>Status</dt><dd class="font-medium text-slate-900">{{ $order->status }}</dd></div>
                    <div class="flex justify-between"><dt>Total</dt><dd class="font-bold text-slate-900">£{{ number_format($order->total, 2) }}</dd></div>
                </dl>

                <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="mt-6">
                    @csrf
                    @method('PUT')
                    <label class="mb-2 block text-sm font-medium text-slate-700">Update status</label>
                    <select name="status" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-emerald-500 focus:outline-none">
                        <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    <button type="submit" class="mt-5 w-full rounded-full bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-500">Save status</button>
                </form>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
