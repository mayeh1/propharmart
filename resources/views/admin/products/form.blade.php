<x-app-layout>
<div class="py-12">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        <div class="mb-6 flex items-center justify-between">
            <div>
                <p class="text-sm font-semibold uppercase tracking-[0.2em] text-emerald-700">Product</p>
                <h1 class="mt-2 text-3xl font-black tracking-tight text-slate-900">{{ isset($product->id) ? 'Edit product' : 'Create product' }}</h1>
            </div>
            <a href="{{ route('admin.products.index') }}" class="text-sm font-semibold text-slate-700 hover:text-emerald-700">Back to products</a>
        </div>

        <form method="POST" action="{{ isset($product->id) ? route('admin.products.update', $product) : route('admin.products.store') }}" enctype="multipart/form-data" class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
            @csrf
            @if(isset($product->id))
                @method('PUT')
            @endif

            <div class="grid gap-6 md:grid-cols-2">
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Name</label>
                    <input type="text" name="name" value="{{ old('name', $product->name ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none" required>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">SKU</label>
                    <input type="text" name="sku" value="{{ old('sku', $product->sku ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none" required>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Category</label>
                    @php($currentCategory = old('category', $product->category ?? ''))
                    @php($isNewCategory = $currentCategory !== '' && !$categories->contains($currentCategory))
                    <select name="category" id="category-select" onchange="document.getElementById('category-new').classList.toggle('hidden', this.value !== '__new__')" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none" required>
                        <option value="" disabled {{ $currentCategory === '' ? 'selected' : '' }}>Select a category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category }}" {{ $currentCategory === $category ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach
                        <option value="__new__" {{ $isNewCategory ? 'selected' : '' }}>+ Add new category</option>
                    </select>
                    <input type="text" name="new_category" id="category-new" value="{{ $isNewCategory ? $currentCategory : old('new_category') }}" placeholder="New category name" class="mt-2 w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none {{ $isNewCategory ? '' : 'hidden' }}">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Status</label>
                    <select name="status" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">
                        <option value="draft" {{ old('status', $product->status ?? 'draft') === 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ old('status', $product->status ?? 'draft') === 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Price</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price ?? 0) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none" required>
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Compare Price</label>
                    <input type="number" step="0.01" name="compare_price" value="{{ old('compare_price', $product->compare_price ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">
                </div>
                <div>
                    <label class="mb-2 block text-sm font-medium text-slate-700">Stock</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock ?? 0) }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none" required>
                </div>
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Product images</label>
                    @if(isset($product->id) && $product->images->isNotEmpty())
                        <div class="mb-3 grid grid-cols-4 gap-3 sm:grid-cols-6 lg:grid-cols-8">
                            @foreach($product->images as $image)
                                <label class="group relative block cursor-pointer">
                                    <img src="{{ $image->url }}" alt="Product image" class="h-20 w-20 rounded-xl border border-slate-200 object-cover group-has-[:checked]:opacity-40">
                                    <input type="checkbox" name="delete_images[]" value="{{ $image->id }}" class="absolute right-1 top-1 h-4 w-4 rounded border-slate-300 text-red-600 focus:ring-red-500">
                                </label>
                            @endforeach
                        </div>
                        <p class="mb-2 text-xs text-slate-500">Tick an image to remove it when you save.</p>
                    @endif
                    <input type="file" name="images[]" multiple accept="image/*" class="w-full rounded-xl border border-slate-200 px-4 py-3 text-sm focus:border-emerald-500 focus:outline-none">
                    <p class="mt-1 text-xs text-slate-500">JPG, PNG or WebP, up to 4MB each. Select multiple files to add several images.</p>
                </div>
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Short description</label>
                    <input type="text" name="short_description" value="{{ old('short_description', $product->short_description ?? '') }}" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">
                </div>
                <div class="md:col-span-2">
                    <label class="mb-2 block text-sm font-medium text-slate-700">Description</label>
                    <textarea name="description" rows="5" class="w-full rounded-xl border border-slate-200 px-4 py-3 focus:border-emerald-500 focus:outline-none">{{ old('description', $product->description ?? '') }}</textarea>
                </div>
                <div class="md:col-span-2 flex items-center gap-3">
                    <input type="checkbox" name="featured" value="1" {{ old('featured', $product->featured ?? false) ? 'checked' : '' }} class="h-4 w-4 rounded border-slate-300 text-emerald-600 focus:ring-emerald-500">
                    <label class="text-sm font-medium text-slate-700">Mark as featured</label>
                </div>
            </div>

            <div class="mt-8 flex justify-end gap-3">
                <a href="{{ route('admin.products.index') }}" class="rounded-full border border-slate-200 px-5 py-2.5 text-sm font-semibold text-slate-700">Cancel</a>
                <button type="submit" class="rounded-full bg-emerald-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-emerald-500">{{ isset($product->id) ? 'Update product' : 'Save product' }}</button>
            </div>
        </form>
    </div>
</div>
</x-app-layout>
