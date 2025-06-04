<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::query()
            ->select(['id', 'name', 'slug', 'price', 'stock', 'status', 'category_id'])
            ->with('category:id,name,slug')
            ->where('status', 'active')
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->category);
                });
            })
            ->when($request->sort === 'price_asc', fn($query) => $query->orderBy('price', 'asc'))
            ->when($request->sort === 'price_desc', fn($query) => $query->orderBy('price', 'desc'))
            ->paginate(15);

        return ProductResource::collection($products);
    }
}
