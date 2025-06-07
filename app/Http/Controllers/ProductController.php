<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function __construct(protected ProductService $productService)
    {
        //
    }

    public function index(Request $request)
    {
        $products = $this->productService->getProducts($request);
        $categories = $this->productService->getCachedCategories();

        return view('products.index', compact('products', 'categories'));
    }

    public function show($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();

        return view('products.show', compact('product'));
    }
}
