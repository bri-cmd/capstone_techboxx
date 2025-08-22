<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen">

<div class="max-w-3xl mx-auto mt-10 bg-white p-6 rounded-lg shadow">
    <h1 class="text-2xl font-bold mb-6">Checkout</h1>

    <ul class="divide-y divide-gray-200 mb-6">
        @foreach($items as $id => $item)
            <li class="py-4 flex justify-between">
                <span>{{ $item['name'] }} (x{{ $item['quantity'] }})</span>
                <span>₱{{ number_format($item['price'] * $item['quantity'], 2) }}</span>
            </li>
        @endforeach
    </ul>

    <p class="text-xl font-semibold">
        Grand Total: 
        ₱{{ number_format(collect($items)->sum(fn($i) => $i['price'] * $i['quantity']), 2) }}
    </p>

    <button class="mt-6 bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700">
        Place Order
    </button>
</div>

</body>
</html>
