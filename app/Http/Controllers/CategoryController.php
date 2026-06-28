<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function category()
{   $categories = Category::all();
    return view('frontend.category',compact('categories'));
}

    // Show Products of Selected Category
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        $products = $category->products()
                    ->where('is_active', 1)
                    ->paginate(12);

        return view('frontend.product.index', compact('category', 'products'));
    }
}
