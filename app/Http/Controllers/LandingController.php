<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class LandingController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $cart = session()->get('cart', []);

        return view('landing', compact('products', 'cart'));
    }
}
