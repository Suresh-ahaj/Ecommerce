<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;


class Pagecontroller extends Controller
{

      public function index()
    {
        // Get all active brands
        $brands = Brand::where('is_active', 1)
            ->orderBy('name')
            ->limit(4)
            ->get();

        // Get all active categories with product count
        $categories = Category::where('is_active', 1)
            ->withCount('products')
            ->orderBy('name')
            ->limit(4)
            ->get();

        // Get featured products or latest products for homepage
        $featuredProducts = Product::where('is_active', 1)
            ->where('is_featured', 1)
            ->latest()
            ->limit(8)
            ->get();

        return view('frontend.home', compact(
            'brands',
            'categories',
            'featuredProducts'
        ));
    }


}
