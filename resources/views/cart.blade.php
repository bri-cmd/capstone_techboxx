<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

    <!-- Page Header -->
    <div class="w-full shadow-lg">
        <div class="bg-gradient-to-r from-blue-900 to-blue-700 text-white px-6 py-5 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <span class="text-2xl"></span>
                <h1 class="text-2xl md:text-3xl font-extrabold">Maddox.qwe | Shopping Cart</h1>
            </div>
        </div>
    </div>

    <div class="w-full">
        <div class="rounded-xl p-6 w-full">

            @if(session('success'))
                <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-800 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if(!empty($cart))
                <div class="mb-4">
                    <a href="{{ route('landing') }}" class="text-gray-700 hover:text-blue-900 font-medium">
                        ← Continue Shopping
                    </a>
                </div>

                <!-- Cart Table -->
                <div class="overflow-x-auto border border-gray-200 rounded-xl mb-6">
                    <table class="w-full border-collapse">
                        <thead>
                            <tr class=" text-gray-700 text-xs md:text-sm uppercase tracking-wide border-b border-100">
                                <th class="p-4 text-center w-12"></th>
                                <th class="p-4 text-left w-[30%]">Component</th>
                                <th class="p-4 text-left">Category</th>
                                <th class="p-4 text-center">Price</th>
                                <th class="p-4 text-center">Quantity</th>
                                <th class="p-4 text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @foreach($cart as $id => $item)
                                @php $itemTotal = $item['price'] * $item['quantity']; @endphp
                                <tr class="hover:bg-gray-50 transition">
                                    <!-- Checkbox -->
                                    <td class="p-4 text-center">
                                        <input type="checkbox" class="item-checkbox w-4 h-4 text-blue-600 rounded border-gray-300"
                                            data-total="{{ $itemTotal }}">
                                    </td>

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

                                    <!-- Remove -->
                                    <td class="p-4 text-center">
                                        <form action="{{ route('cart.remove', $id) }}" method="POST" onsubmit="return confirm('Remove this item?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center gap-2 px-3 py-1.5 rounded-md text-red-600 hover:bg-red-50">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

               <!-- Cart Summary BELOW the table -->
                    <div class="rounded-xl p-5 w-full md:w-2/3 lg:w-1/2">
                        <div class="mb-4">
                            <p class="text-lg font-bold text-gray-800">Cart Summary</p>
                        </div>

                        <!-- Horizontal row: Select All + Total + Checkout -->
                        <div class="flex items-center gap-6">
                            <!-- Left: Select All -->
                            <label class="flex items-center gap-2">
                                <input type="checkbox" id="select-all" class="w-4 h-4 text-blue-600 rounded border-gray-300">
                                <span class="text-sm text-gray-700">Select All</span>
                            </label>

                            <!-- Middle: Total Selected -->
                            <p class="text-sm text-gray-700 flex items-center">
                                Total:
                                <span id="cart-summary-total" class="text-lg font-extrabold text-gray-600 ml-2">₱0.00</span>
                            </p>

                            <!-- Right: Checkout -->
                            <form id="checkout-form" action="{{ route('cart.checkout') }}" method="GET">
                                <input type="hidden" name="selected_items" id="selected-items">
                                <button type="submit"
                                    class="bg-pink-400 hover:bg-blue-700 text-white px-5 py-2 rounded-lg font-semibold transition">
                                    Checkout
                                </button>
                            </form>

                        </div>
                    </div>


            @else
                <div class="text-center py-16">
                    <p class="text-gray-600 text-lg mb-4">🛍️ Your cart is empty.</p>
                    <a href="{{ route('landing') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg transition">
                        Start Shopping
                    </a>
                </div>
            @endif
        </div>
    </div>

    <script>
    const selectAll = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.item-checkbox');
    const summaryTotal = document.getElementById('cart-summary-total');

    // Load saved checkbox states
    const savedChecked = JSON.parse(localStorage.getItem('checkedItems') || '[]');
    checkboxes.forEach((cb, index) => {
        if (savedChecked.includes(index)) {
            cb.checked = true;
        }
    });
    updateTotal();

    function updateTotal() {
        let total = 0;
        checkboxes.forEach(cb => {
            if (cb.checked) {
                total += parseFloat(cb.dataset.total);
            }
        });
        summaryTotal.textContent = '₱' + total.toLocaleString(undefined, {minimumFractionDigits: 2});

        // Save checked indexes in localStorage
        const checkedIndexes = [];
        checkboxes.forEach((cb, i) => {
            if (cb.checked) checkedIndexes.push(i);
        });
        localStorage.setItem('checkedItems', JSON.stringify(checkedIndexes));
    }

    selectAll?.addEventListener('change', (e) => {
        checkboxes.forEach(cb => cb.checked = e.target.checked);
        updateTotal();
    });

    checkboxes.forEach(cb => cb.addEventListener('change', updateTotal));

    const checkoutForm = document.getElementById('checkout-form');
const selectedItemsInput = document.getElementById('selected-items');

checkoutForm.addEventListener('submit', (e) => {
    const selectedIds = [];

    checkboxes.forEach((cb, index) => {
        if (cb.checked) {
            // match checkbox index with cart item key
            const itemId = Object.keys(@json($cart))[index]; 
            selectedIds.push(itemId);
        }
    });

    if (selectedIds.length === 0) {
        e.preventDefault();
        alert("Please select at least one item before checkout.");
        return;
    }

    // Put IDs into hidden input
    selectedItemsInput.value = JSON.stringify(selectedIds);
});

</script>


</body>
</html>
