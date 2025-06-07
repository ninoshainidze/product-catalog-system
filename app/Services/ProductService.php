<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function getProducts(Request $request)
    {
        return Product::with('category')
            ->when($request->category, function ($query, $slug) {
                $query->whereHas('category', fn($q) => $q->where('slug', $slug));
            })
            ->when($request->sort === 'price_asc', fn($q) => $q->orderBy('price', 'asc'))
            ->when($request->sort === 'price_desc', fn($q) => $q->orderBy('price', 'desc'))
            ->orderByDesc('created_at')
            ->paginate(15);
    }

    public function getCachedCategories()
    {
        return Cache::remember('categories', now()->addHour(), function () {
            return Category::select('id', 'name', 'slug')->get();
        });
    }
}
