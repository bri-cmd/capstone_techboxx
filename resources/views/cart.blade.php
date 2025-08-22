<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-lg p-6">
        <!-- Header -->
        <h1 class="text-3xl font-extrabold text-gray-800 border-b pb-4 mb-6 flex items-center gap-2">
            🛒 <span>Shopping Cart</span>
        </h1>

        <!-- Flash message -->
        @if(session('success'))
            <div class="mb-4 p-3 bg-green-100 border border-green-300 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        @if(!empty($cart))
            <div class="overflow-x-auto">
                <table class="w-full border-collapse rounded-lg overflow-hidden shadow-sm">
                    <thead>
                        <tr class="bg-pink-100 text-gray-700 text-sm uppercase tracking-wide">
                            <th class="p-3 text-left">Component</th>
                            <th class="p-3 text-left">Category</th>
                            <th class="p-3 text-left">Price</th>
                            <th class="p-3 text-center">Quantity</th>
                            <th class="p-3 text-right">Total</th>
                            <th class="p-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @php $grandTotal = 0; @endphp
                        @foreach($cart as $id => $item)
                            @php 
                                $itemTotal = $item['price'] * $item['quantity']; 
                                $grandTotal += $itemTotal; 
                            @endphp
                            <tr class="hover:bg-gray-50 transition">
                                <!-- Product -->
                                <td class="p-3 flex items-center gap-3">
                                    <img src="{{ $item['image'] ?? 'https://via.placeholder.com/60' }}" 
                                         alt="{{ $item['name'] }}" 
                                         class="w-14 h-14 object-cover rounded-lg border">
                                    <span class="font-semibold text-gray-800">{{ $item['name'] }}</span>
                                </td>

                                <!-- Category -->
                                <td class="p-3 text-gray-600">
                                    {{ $item['category'] ?? 'N/A' }}
                                </td>

                                <!-- Price -->
                                <td class="p-3 text-gray-700">
                                    ₱{{ number_format($item['price'], 2) }}
                                </td>

                                <!-- Quantity -->
                                <td class="p-3 text-center">
                                    <form action="{{ route('cart.update', $id) }}" method="POST" class="inline-flex items-center border rounded-lg overflow-hidden">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" name="action" value="decrease" 
                                                class="px-3 py-1 text-gray-600 hover:bg-gray-200">
                                            −
                                        </button>
                                        <span class="px-4 font-medium">{{ $item['quantity'] }}</span>
                                        <button type="submit" name="action" value="increase" 
                                                class="px-3 py-1 text-gray-600 hover:bg-gray-200">
                                            +
                                        </button>
                                    </form>
                                </td>

                                <!-- Total -->
                                <td class="p-3 text-right font-semibold text-gray-900">
                                    ₱{{ number_format($itemTotal, 2) }}
                                </td>

                                <!-- Remove -->
                                <td class="p-3 text-center">
                                    <form action="{{ route('cart.remove', $id) }}" method="POST" 
                                          onsubmit="return confirm('Remove this item?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-500 hover:text-red-700 font-medium">
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Summary -->
            <div class="mt-6 border-t pt-4 flex flex-col sm:flex-row justify-between items-center">
                <a href="{{ route('landing') }}" 
                   class="text-blue-600 hover:text-blue-800 transition mb-3 sm:mb-0">
                    ← Continue Shopping
                </a>

                <div class="bg-gray-50 p-5 rounded-lg shadow-md text-right">
                    <p class="text-xl font-bold text-gray-800">
                        Total: <span class="text-green-600">₱{{ number_format($grandTotal, 2) }}</span>
                    </p>
                    <button class="mt-3 bg-pink-500 hover:bg-pink-600 text-white px-6 py-2 rounded-lg transition">
                        Proceed to Checkout
                    </button>
                </div>
            </div>

        @else
            <!-- Empty -->
            <div class="text-center py-12">
                <p class="text-gray-600 text-lg">🛍️ Your cart is empty.</p>
                <a href="{{ route('landing') }}" 
                   class="mt-4 inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                    Start Shopping
                </a>
            </div>
        @endif
    </div>

</body>
</html>
