<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::published()->with('images')->where('featured', true)->latest()->take(8)->get();
        $products = Product::published()->with('images')->latest()->take(8)->get();

        return view('storefront.index', [
            'settings' => SiteSetting::all()->pluck('value', 'key')->toArray(),
            'featuredProducts' => $featuredProducts,
            'products' => $products,
            'categories' => $this->categories(),
        ]);
    }

    public function shop(Request $request)
    {
        $query = Product::published()->with('images');

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('short_description', 'like', '%'.$request->search.'%');
            });
        }

        $products = $query->latest()->paginate(12);

        return view('storefront.shop', [
            'settings' => SiteSetting::all()->pluck('value', 'key')->toArray(),
            'products' => $products,
            'categories' => $this->categories(),
        ]);
    }

    protected function categories()
    {
        return Product::published()->distinct()->orderBy('category')->pluck('category');
    }

    public function show(Product $product)
    {
        $product->load('images');

        return view('storefront.product', [
            'settings' => SiteSetting::all()->pluck('value', 'key')->toArray(),
            'product' => $product,
            'relatedProducts' => Product::published()->with('images')->where('category', $product->category)->where('id', '!=', $product->id)->take(4)->get(),
        ]);
    }
}
