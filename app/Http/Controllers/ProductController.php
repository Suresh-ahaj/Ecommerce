<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // dd($request->all());

        $query = Product::where('is_active', 1);

        // Filter by categories
        if ($request->has('categories') && !empty($request->categories)) {
            $categories = array_filter($request->categories);
            if (!empty($categories)) {
                $query->whereIn('category_id', $categories);
            }
        }

        // Filter by brands
        if ($request->has('brands') && !empty($request->brands)) {
            $brands = array_filter($request->brands);
            if (!empty($brands)) {
                $query->whereIn('brand_id', $brands);
            }
        }

        // Filter by stock status
        if ($request->has('in_stock') && $request->in_stock == 1) {
            $query->where('in_stock', 1);
        }

        // Filter by on sale
        if ($request->has('on_sale') && $request->on_sale == 1) {
            $query->where('on_sale', 1);
        }

        // Filter by price range
        if ($request->has('max_price') && $request->max_price > 0) {
            $query->where('price', '<=', $request->max_price);
        }

        if ($request->has('min_price') && $request->min_price > 0) {
            $query->where('price', '>=', $request->min_price);
        }

        // Sort by
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'latest':
                default:
                    $query->latest();
                    break;
            }
        } else {
            $query->latest();
        }

        $products = $query->paginate(12)->withQueryString();

        $brands = Brand::where('is_active', 1)->get();
        $categories = Category::where('is_active', 1)->get();

        // Pass the request to view for preserving filter state
        return view('frontend.product.index', compact(
            'products',
            'brands',
            'categories',
            'request'
        ));
    }

    public function show($slug)
    {
        $product = Product::with(['brand', 'category'])
            ->where('slug', $slug)
            ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', 1)
            ->limit(4)
            ->get();

    // Get cart count for badge
    $cartCount = session()->get('cart', []);
    $cartCount = array_sum(array_column($cartCount, 'quantity'));

        return view('frontend.product.show', compact('product', 'relatedProducts','cartCount'));
    }
}
