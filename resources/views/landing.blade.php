<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>TechBoxx PC Builder Simulator</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-900 font-sans">

  <!-- Navbar -->
  <nav class="flex justify-between items-center px-8 py-4 bg-gradient-to-r from-blue-900 to-blue-700 text-white shadow-md">
    <div class="text-xl font-bold">Madoxx.Qwe</div>

  <!-- Right: Nav links + Buttons -->
  <div class="flex items-center gap-6">
    <ul class="hidden md:flex gap-8 text-lg">
      <li><a href="#" class="hover:text-yellow-400 transition">Your Builds</a></li>
      <li><a href="/cart" class="hover:text-yellow-400 transition">Cart</a></li>
      <li><a href="/catalog" class="hover:text-yellow-400 transition">Products</a></li>
    </ul>
    <div class="flex gap-3">
      <a href="#" class="px-4 py-2 rounded-lg bg-white text-blue-700 font-semibold shadow hover:bg-gray-100 transition">Sign In</a>
      <a href="#" class="px-4 py-2 rounded-lg bg-blue-400 text-white font-bold shadow hover:bg-yellow-300 transition">Try 3D Builder</a>
    </div>
  </nav>

  <!-- Hero Section -->
  <section class="text-left bg-gradient-to-b from-blue-800 to-blue-500 py-20 text-white relative overflow-hidden flex items-center justify-between px-10">
    
    <!-- LEFT: Your existing text (unchanged) -->
    <div class="max-w-3xl pl-20">
      <h1 class="text-4xl md:text-6xl font-extrabold leading-tight">TechBoxx PC Builder Simulator</h1>
      <p class="mt-4 text-xl text-gray-200">Don’t just buy it. <span class="font-semibold">BUILD</span> it.</p>
      <a href="#builder" class="mt-8 inline-block px-8 py-3 bg-gray-600 text-white font-bold rounded-xl shadow-lg hover:bg-yellow-300 transition">
        Design yours →
      </a>
    </div>

    <!-- RIGHT: Only adjusted image -->
    <div class="px-40 flex items-center">
      <img src="{{ asset('image 5.png') }}" 
           alt="PC Simulator Demo" 
           class="w-80 md:w-[430px] object-contain">
    </div>

</section>


  <!-- PC Builder Simulator Section -->
  <section id="builder" class="grid md:grid-cols-2 items-center gap-12 px-8 py-20 max-w-6xl mx-auto">
    <div>
      <h2 class="text-3xl md:text-4xl font-bold">PC Builder Simulator</h2>
      <p class="mt-4 text-lg text-gray-600 leading-relaxed">
        Build and visualize custom PC setups in real-time. Add parts, check compatibility, and explore your build in full 3D.
      </p>
      <a href="#" class="mt-8 inline-block px-6 py-3 bg-blue-700 text-white font-semibold rounded-lg shadow hover:bg-blue-600 transition">Get Started →</a>
    </div>
    <div class="flex justify-center">
      <img src="{{ asset('121.png') }}" alt="PC Simulator Demo" class="">
    </div>
  </section>

  <!-- See Components Section -->
  <section class="grid md:grid-cols-2 items-center gap-12 px-8 py-20 bg-gray-50 max-w-6xl mx-auto">
    <div class="flex justify-center">
      <img src="{{ asset('2W1.png') }}" alt="Components" class="">
    </div>
    <div>
      <h2 class="text-3xl md:text-4xl font-bold">See Components</h2>
      <p class="mt-4 text-lg text-gray-600 leading-relaxed">
        Browse and assemble PC parts in a full 3D builder. Instantly check compatibility as you shop from our interactive catalog.
      </p>
      <a href="#" class="mt-8 inline-block px-6 py-3 bg-blue-700 text-white font-semibold rounded-lg shadow hover:bg-blue-600 transition">Browse Now →</a>
    </div>
  </section>

  <!-- Featured Products Section -->
<section id="products" class="px-8 py-20 max-w-6xl mx-auto">
  <h2 class="text-3xl md:text-4xl font-bold text-center mb-12">Featured Products</h2>
  
  <div class="grid grid-cols-3 gap-6">
    @foreach($products as $product)
        <div class="border rounded-xl p-4 shadow">
            <img src="{{ asset('images/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded-md">
            
            <h3 class="text-lg font-bold mt-2">{{ $product->name }}</h3>
            <p class="text-gray-600">₱{{ number_format($product->price, 2) }}</p>

            <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
    @csrf
    <input type="hidden" name="product_id" value="{{ $product->id }}">
    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
        Add to Cart
    </button>
</form>

        </div>
    @endforeach
  </div>
</section>



  <!-- Footer -->
  <footer class="text-center py-6 bg-gray-900 text-gray-400 text-sm">
    © 2025 TechBoxx. All rights reserved.
  </footer>

</body>

<script>
function addToCart(productId, price) {
    const qty = document.querySelector(`#qty-${productId}`).value;

    fetch("{{ route('cart.add') }}", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        },
        body: JSON.stringify({
            product_id: productId,
            quantity: qty,
            price: price
        })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.message);
    });
}
</script>

</html>
