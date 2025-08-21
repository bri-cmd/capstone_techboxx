<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Catalog</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-900">

  <!-- Navbar -->
  <nav class="flex justify-between items-center px-8 py-4 bg-gradient-to-r from-blue-900 to-blue-700 text-white shadow-md">
    <div class="text-xl font-bold">Madoxx.Qwe</div>
    <ul class="flex gap-8 text-lg">
      <li><a href="/" class="hover:text-yellow-400 transition">Home</a></li>
      <li><a href="/catalog" class="hover:text-yellow-400 transition">Products</a></li>
      <li><a href="/cart" class="hover:text-yellow-400 transition">Cart</a></li>
    </ul>
  </nav>

  <!-- Catalog -->
  <section class="max-w-6xl mx-auto py-20 px-6">
    <h1 class="text-4xl font-bold mb-12 text-center">PC Components</h1>
    
    <div class="grid md:grid-cols-3 gap-10">
      
      <!-- CPU -->
      <div class="bg-white shadow-lg rounded-xl overflow-hidden hover:scale-105 transition">
        <a href="{{ url('/product/1') }}">
          <img src="{{ asset('cpu.png') }}" alt="CPU" class="w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-bold">Intel Core i9</h3>
            <p class="text-gray-600 mt-2">$499</p>
          </div>
        </a>
      </div>

      <!-- GPU -->
      <div class="bg-white shadow-lg rounded-xl overflow-hidden hover:scale-105 transition">
        <a href="{{ url('/product/2') }}">
          <img src="{{ asset('gpu.png') }}" alt="GPU" class="w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-bold">NVIDIA RTX 4080</h3>
            <p class="text-gray-600 mt-2">$1199</p>
          </div>
        </a>
      </div>

      <!-- RAM -->
      <div class="bg-white shadow-lg rounded-xl overflow-hidden hover:scale-105 transition">
        <a href="{{ url('/product/3') }}">
          <img src="{{ asset('ram.png') }}" alt="RAM" class="w-full h-48 object-cover">
          <div class="p-4">
            <h3 class="text-lg font-bold">Corsair 16GB DDR5</h3>
            <p class="text-gray-600 mt-2">$129</p>
          </div>
        </a>
      </div>

    </div>
  </section>

</body>
</html>
