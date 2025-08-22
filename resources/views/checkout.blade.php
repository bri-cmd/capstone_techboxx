<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Page Header -->
    <div class="w-full shadow-lg">
        <div class="bg-gradient-to-r from-blue-900 to-blue-700 text-white px-6 py-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <h1 class="text-2xl md:text-3xl font-extrabold">Maddox.qwe | Checkout</h1>
            </div>
        </div>
    </div>

    <div class="w-full">
        <div class="rounded-xl p-6 w-full">

            <!-- Back to cart -->
            <div class="mb-4">
                <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-blue-900 font-medium">
                    ← Back to Cart
                </a>
            </div>

            <!-- Checkout Table -->
            <div class="overflow-x-auto border border-gray-200 rounded-xl mb-6">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="text-gray-700 text-xs md:text-sm uppercase tracking-wide border-b border-100">
                            <th class="p-4 text-left w-[30%]">Component</th>
                            <th class="p-4 text-left">Category</th>
                            <th class="p-4 text-center">Price</th>
                            <th class="p-4 text-center">Quantity</th>
                            <th class="p-4 text-center">Total</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 text-sm">
                        @foreach($items as $id => $item)
                            @php $itemTotal = $item['price'] * $item['quantity']; @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <!-- Product -->
                                <td class="p-4">
                                    <div class="flex items-center gap-4">
                                        <img
                                            src="{{ $item['image'] ?? 'https://via.placeholder.com/72' }}"
                                            alt="{{ $item['name'] }}"
                                            class="w-16 h-16 md:w-20 md:h-20 object-cover rounded-lg border border-gray-200 shadow-sm"
                                        />
                                        <div>
                                            <div class="font-semibold text-gray-800">{{ $item['name'] }}</div>
                                            @if(!empty($item['sku']))
                                                <div class="text-xs text-gray-500">SKU: {{ $item['sku'] }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>

                                <!-- Category -->
                                <td class="p-4 text-gray-600">
                                    {{ $item['category'] ?? '—' }}
                                </td>

                                <!-- Price -->
                                <td class="p-4 text-center text-gray-800">
                                    ₱{{ number_format($item['price'], 2) }}
                                </td>

                                <!-- Quantity -->
                                <td class="p-4 text-center">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" 
                                          class="inline-flex items-center rounded-full border border-gray-300 overflow-hidden shadow-sm">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="action" value="decrease"
                                                class="h-9 w-9 grid place-items-center text-gray-700 hover:bg-gray-100">
                                            <span class="text-lg leading-none">−</span>
                                        </button>
                                        <span class="px-4 font-semibold text-gray-900 select-none">{{ $item['quantity'] }}</span>
                                        <button type="submit" name="action" value="increase"
                                                class="h-9 w-9 grid place-items-center text-gray-700 hover:bg-gray-100">
                                            <span class="text-lg leading-none">+</span>
                                        </button>
                                    </form>
                                </td>

                                <!-- Item Total -->
                                <td class="p-4 text-center font-semibold text-gray-900">
                                    ₱{{ number_format($itemTotal, 2) }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Checkout Summary -->
            <div class="rounded-xl p-5 w-full md:w-2/3 lg:w-1/2">
                <div class="mb-4">
                    <p class="text-lg font-bold text-gray-800">Order Summary</p>
                </div>

                <!-- Grand Total -->
                <div class="flex items-center justify-between mb-4">
                    <span class="text-gray-700">Grand Total:</span>
                    <span class="text-xl font-extrabold text-gray-900">
                        ₱{{ number_format(collect($items)->sum(fn($i) => $i['price'] * $i['quantity']), 2) }}
                    </span>
                </div>

                <!-- Payment Methods -->
                <div class="mb-6">
                    <p class="text-gray-700 mb-2 font-medium">Payment Method:</p>
                    <div class="flex gap-4">
                        <button type="button" class="px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg font-semibold hover:bg-yellow-500">
                            PayPal
                        </button>
                        <button type="button" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg font-semibold hover:bg-gray-300">
                            Cash On Pickup
                        </button>
                    </div>
                </div>

                <!-- Checkout Button -->
                <form action="{{ route('checkout.process') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full bg-pink-500 hover:bg-pink-600 text-white px-6 py-3 rounded-lg font-semibold transition">
                        Place Order
                    </button>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
