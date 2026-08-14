<x-app-layout>
<div class="py-12">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mb-8 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Dashboard</p>
                <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900">{{ $siteName }}</h1>
            </div>
            <a href="{{ route('admin.products.create') }}" class="rounded-full bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-emerald-500">Add product</a>
        </div>

        <div class="grid gap-6 md:grid-cols-3">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="text-sm text-slate-500">Total products</div>
                <div class="mt-3 text-3xl font-black text-slate-900">{{ $totalProducts }}</div>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="text-sm text-slate-500">Published</div>
                <div class="mt-3 text-3xl font-black text-slate-900">{{ $publishedProducts }}</div>
            </div>
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="text-sm text-slate-500">Featured</div>
                <div class="mt-3 text-3xl font-black text-slate-900">{{ $featuredProducts }}</div>
            </div>
        </div>

        <div class="mt-10 rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            <div class="mb-5 flex items-center justify-between">
                <h2 class="text-xl font-bold text-slate-900">Recent products</h2>
                <a href="{{ route('admin.products.index') }}" class="text-sm font-semibold text-emerald-700">Manage products</a>
            </div>
            <div class="overflow-hidden rounded-xl border border-slate-200">
                <table class="min-w-full divide-y divide-slate-200 text-left">
                    <thead class="bg-slate-50 text-sm font-semibold text-slate-600">
                        <tr>
                            <th class="px-4 py-3">Product</th>
                            <th class="px-4 py-3">Category</th>
                            <th class="px-4 py-3">Price</th>
                            <th class="px-4 py-3">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200 bg-white text-sm text-slate-700">
                        @foreach($recentProducts as $product)
                            <tr>
                                <td class="px-4 py-3 font-medium text-slate-900">{{ $product->name }}</td>
                                <td class="px-4 py-3">{{ $product->category }}</td>
                                <td class="px-4 py-3">£{{ number_format($product->price, 2) }}</td>
                                <td class="px-4 py-3">
                                    <span class="rounded-full {{ $product->status === 'published' ? 'bg-emerald-100 text-emerald-700' : 'bg-amber-100 text-amber-700' }} px-2.5 py-1 text-xs font-semibold uppercase tracking-[0.14em]">
                                        {{ $product->status }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</x-app-layout>
