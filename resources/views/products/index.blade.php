@extends('layouts.app')

@section('content')
    <h1 class="text-2xl font-bold mb-6">Product Listing</h1>

    <!-- Filters -->
    <form method="GET" class="mb-6 flex flex-wrap gap-4 items-center">
        <select name="category" class="border rounded px-3 py-2">
            <option value="">All Categories</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->slug }}" {{ request('category') === $cat->slug ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        <select name="sort" class="border rounded px-3 py-2">
            <option value="">Sort By</option>
            <option value="price_asc" {{ request('sort') === 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
            <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
        </select>

        <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">
            Filter
        </button>

        @if(request('category') || request('sort'))
            <a href="{{ route('products.index') }}"
               class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                Clear
            </a>
        @endif
    </form>

    <!-- Product Table -->
    <div class="overflow-x-auto bg-white shadow rounded-lg">
        <table class="w-full table-auto text-sm text-left">
            <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="px-4 py-3 border-b">Name</th>
                <th class="px-4 py-3 border-b">Category</th>
                <th class="px-4 py-3 border-b">Price</th>
                <th class="px-4 py-3 border-b">Stock</th>
                <th class="px-4 py-3 border-b text-right">Action</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            @forelse ($products as $product)
                <tr>
                    <td class="px-4 py-3">{{ $product->name }}</td>
                    <td class="px-4 py-3">{{ $product->category->name ?? '-' }}</td>
                    <td class="px-4 py-3">${{ number_format($product->price, 2) }}</td>
                    <td class="px-4 py-3">{{ $product->stock }}</td>
                    <td class="px-4 py-3 text-right">
                        <a href="{{ route('products.show', $product->slug) }}" class="text-indigo-600 hover:underline">View</a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="px-4 py-4 text-center text-gray-500">No products found.</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="mt-6">
        {{ $products->withQueryString()->links() }}
    </div>
@endsection
