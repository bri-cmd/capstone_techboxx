<!DOCTYPE html>
<html>
<head>
    <title>Your Cart</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="p-8">
    <h1 class="text-2xl font-bold mb-4">Your Cart</h1>

    @if(session('success'))
        <p class="text-green-600">{{ session('success') }}</p>
    @endif

    @if(!empty($cart))
        <table border="1" cellpadding="8">
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Qty</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
            @foreach($cart as $id => $item)
                <tr>
                    <td>{{ $item['name'] }}</td>
                    <td>₱{{ number_format($item['price'], 2) }}</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>₱{{ number_format($item['price'] * $item['quantity'], 2) }}</td>
                    <td>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded">
                                Remove
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>
    @else
        <p>No items in your cart.</p>
    @endif

    <br>
    <a href="{{ route('landing') }}" class="text-blue-600 underline">← Continue Shopping</a>
</body>
</html>
