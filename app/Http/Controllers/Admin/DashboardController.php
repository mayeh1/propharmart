<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $publishedProducts = Product::where('status', 'published')->count();
        $featuredProducts = Product::where('featured', true)->count();
        $recentProducts = Product::latest()->take(5)->get();

        return view('admin.dashboard', [
            'totalProducts' => $totalProducts,
            'publishedProducts' => $publishedProducts,
            'featuredProducts' => $featuredProducts,
            'recentProducts' => $recentProducts,
            'siteName' => SiteSetting::getValue('site_name', 'PROPHAMART'),
        ]);
    }
}
