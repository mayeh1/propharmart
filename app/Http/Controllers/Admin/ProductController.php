<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('images')->latest()->paginate(12);

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.form', [
            'product' => new Product(),
            'categories' => $this->categories(),
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku',
            'category' => 'required|string|max:100',
            'new_category' => 'required_if:category,__new__|nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|max:4096',
            'featured' => 'nullable|boolean',
            'status' => 'required|in:draft,published',
        ]);

        if ($validated['category'] === '__new__') {
            $validated['category'] = $validated['new_category'];
        }
        unset($validated['new_category'], $validated['images']);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['featured'] = $request->boolean('featured');

        $product = Product::create($validated);

        if ($request->hasFile('images')) {
            $this->storeImages($product, $request->file('images'));
        }

        return redirect()->route('admin.products.index')->with('success', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        return view('admin.products.form', [
            'product' => $product,
            'categories' => $this->categories(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:100|unique:products,sku,'.$product->id,
            'category' => 'required|string|max:100',
            'new_category' => 'required_if:category,__new__|nullable|string|max:100',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'short_description' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|max:4096',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'integer|exists:product_images,id',
            'featured' => 'nullable|boolean',
            'status' => 'required|in:draft,published',
        ]);

        if ($validated['category'] === '__new__') {
            $validated['category'] = $validated['new_category'];
        }

        $deleteImageIds = $validated['delete_images'] ?? [];
        unset($validated['new_category'], $validated['images'], $validated['delete_images']);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['featured'] = $request->boolean('featured');

        $product->update($validated);

        if ($deleteImageIds) {
            $product->images()->whereIn('id', $deleteImageIds)->get()->each(function ($image) {
                $this->deleteImageFile($image->url);
                $image->delete();
            });
        }

        if ($request->hasFile('images')) {
            $this->storeImages($product, $request->file('images'));
        }

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy(Product $product)
    {
        $product->images->each(fn ($image) => $this->deleteImageFile($image->url));
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }

    protected function categories()
    {
        return Product::distinct()->orderBy('category')->pluck('category');
    }

    protected function storeImages(Product $product, array $files)
    {
        $order = ($product->images()->max('sort_order') ?? -1) + 1;

        foreach ($files as $file) {
            $product->images()->create([
                'url' => Storage::disk('public')->url($file->store('products', 'public')),
                'sort_order' => $order++,
            ]);
        }
    }

    protected function deleteImageFile(?string $url)
    {
        if (! $url || ! str_starts_with($url, Storage::disk('public')->url(''))) {
            return;
        }

        $path = ltrim(Str::after($url, Storage::disk('public')->url('')), '/');
        Storage::disk('public')->delete($path);
    }
}
