<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $cacheKey = 'products:' . md5(json_encode($request->query()));

        $products = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($request) {
            return Product::with('category')
                ->when($request->category, function ($query, $slug) {
                    $query->whereHas('category', fn($q) => $q->where('slug', $slug));
                })
                ->when($request->sort === 'price_asc', fn($q) => $q->orderBy('price', 'asc'))
                ->when($request->sort === 'price_desc', fn($q) => $q->orderBy('price', 'desc'))
                ->paginate(15);
        });

        return ProductResource::collection($products);
    }
}
