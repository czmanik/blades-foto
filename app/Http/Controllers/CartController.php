<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = array_sum(array_map(fn($item) => $item['price'] * $item['qty'], $cart));
        $shipping = $total >= 2000 ? 0 : 290;

        return view('cart.index', compact('cart', 'total', 'shipping'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'product_price' => 'required|numeric|min:0',
        ]);

        $cart = session('cart', []);
        $key = Str::slug($request->product_name);

        if (isset($cart[$key])) {
            $cart[$key]['qty']++;
        } else {
            $cart[$key] = [
                'name'  => $request->product_name,
                'price' => (float) $request->product_price,
                'size'  => $request->size ?? '',
                'img'   => $request->product_img ?? '',
                'qty'   => 1,
            ];
        }

        session(['cart' => $cart]);

        return redirect()->back()->with('success', 'Produkt přidán do košíku.');
    }

    public function remove($key)
    {
        $cart = session('cart', []);
        unset($cart[$key]);
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Produkt odebrán.');
    }

    public function update(Request $request)
    {
        $cart = session('cart', []);

        foreach ($request->qty as $key => $qty) {
            if (isset($cart[$key])) {
                $qty = (int) $qty;
                if ($qty <= 0) {
                    unset($cart[$key]);
                } else {
                    $cart[$key]['qty'] = $qty;
                }
            }
        }

        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Košík aktualizován.');
    }
}