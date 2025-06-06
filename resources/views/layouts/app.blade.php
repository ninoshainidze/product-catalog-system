<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Product Catalog</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">

<nav class="bg-white shadow mb-6">
    <div class="max-w-7xl mx-auto px-4 py-4 flex justify-between items-center">
        <a href="{{ route('products.index') }}" class="text-lg font-semibold text-indigo-600">Product Catalog</a>
    </div>
</nav>

<main class="max-w-7xl mx-auto px-4">
    @yield('content')
</main>

</body>
</html>
