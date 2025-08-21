<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index()
    {
        // fetch 6 products
        $products = Product::take(6)->get();

        // also fetch cart session data to display
        $cart = session()->get('cart', []);

        return view('landing', compact('products', 'cart'));
    }
}
