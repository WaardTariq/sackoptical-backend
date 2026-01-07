<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function show($slug)
    {
        $product = Product::with(['images', 'variants', 'category', 'attributes'])
                    ->where('slug', $slug)
                    ->firstOrFail();

        $relatedProducts = Product::where('category_id', $product->category_id)
                            ->where('id', '!=', $product->id)
                            ->take(4)
                            ->get();

        return view('frontend.products.show', compact('product', 'relatedProducts'));
    }
}
