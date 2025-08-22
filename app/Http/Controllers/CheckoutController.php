<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function process(Request $request)
    {
        // Example: get cart items from session
        $cart = session()->get('cart', []);

        if (empty($cart)) {
            return redirect()->back()->with('error', 'Your cart is empty!');
        }

        // Here you can handle saving order to database
        // Example:
        // Order::create([...]);

        // Clear cart after successful checkout
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Order placed successfully!');
    }
}
