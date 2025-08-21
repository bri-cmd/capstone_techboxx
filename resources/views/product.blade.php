<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $product['name'] }}</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">

  <!-- Navbar (reuse your navbar here if needed) -->

  <div class="max-w-5xl mx-auto py-20 px-6 grid md:grid-cols-2 gap-12">
    
    <!-- Product Image -->
    <div class="flex justify-center">
      <img src="{{ asset($product['image']) }}" alt="{{ $product['name'] }}" class="w-[400px] rounded-lg shadow-lg object-contain">
    </div>
    
    <!-- Product Details -->
    <div>
      <h1 class="text-4xl font-bold">{{ $product['name'] }}</h1>
      <p class="text-2xl text-blue-700 font-semibold mt-4">${{ $product['price'] }}</p>
      <p class="mt-6 text-lg text-gray-600">{{ $product['description'] }}</p>
      
      <form method="POST" action="/cart/add/{{ $loop->index }}">
        @csrf
        <button class="mt-8 px-6 py-3 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-500 transition">
          Add to Cart
        </button>
      </form>
    </div>
  </div>

</body>
</html>
