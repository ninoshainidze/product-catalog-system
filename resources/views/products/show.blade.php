@extends('layouts.app')

@section('content')
    <div class="bg-white rounded-lg p-6 shadow">
        <h2 class="text-2xl font-bold mb-2">{{ $product->name }}</h2>
        <p class="text-sm text-gray-500">{{ $product->category->name ?? 'Uncategorized' }}</p>

        <div class="text-xl text-indigo-600 font-bold my-4">
            ${{ number_format($product->price, 2) }}
        </div>

        <p class="text-gray-700">{{ $product->description }}</p>

        <a href="{{ route('products.index') }}" class="inline-block mt-6 text-indigo-500 hover:underline">← Back to products</a>
    </div>
@endsection
