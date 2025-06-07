<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
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
        return ProductResource::collection($products);
    }
}
