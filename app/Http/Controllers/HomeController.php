<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function __invoke()
    {
        $featuredProducts = Product::with('category')
            ->where('is_featured', true)
            ->where('stock', '>', 0)
            ->limit(8)
            ->get();

        $latestProducts = Product::with('category')
            ->where('stock', '>', 0)
            ->latest()
            ->limit(8)
            ->get();

        $categories = Category::withCount('products')->get();

        return view('home', compact('featuredProducts', 'latestProducts', 'categories'));
    }
}
