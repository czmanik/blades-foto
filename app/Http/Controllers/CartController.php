<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);
        $total = 0;
        foreach($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        $shipping = ($total > 0 && $total < 2000) ? 290 : 0;

        return view('cart.index', compact('cart', 'total', 'shipping'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string',
            'product_price' => 'required|numeric|min:0',
            'product_image' => 'nullable|string',
            'size' => 'nullable|string',
            'material' => 'nullable|string',
        ]);

        $cart = session('cart', []);
        $id = Str::slug($request->product_name . '-' . $request->size . '-' . $request->material);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $name = $request->product_name;
            if ($request->size || $request->material) {
                $name .= ' (' . $request->size . ', ' . $request->material . ')';
            }

            $cart[$id] = [
                'name' => $name,
                'price' => (float) $request->product_price,
                'image' => $request->product_image,
                'quantity' => 1,
                'options' => [
                    'size' => $request->size,
                    'material' => $request->material,
                ]
            ];
        }

        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Produkt byl přidán do košíku.');
    }

    public function remove($id)
    {
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }

        return redirect()->route('cart.index')->with('success', 'Produkt byl odebrán z košíku.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|string',
            'quantity' => 'required|integer|min:0',
        ]);

        $cart = session('cart', []);
        $id = $request->id;

        if (isset($cart[$id])) {
            if ($request->quantity <= 0) {
                unset($cart[$id]);
            } else {
                $cart[$id]['quantity'] = (int) $request->quantity;
            }
            session(['cart' => $cart]);
        }

        return redirect()->route('cart.index')->with('success', 'Košík byl aktualizován.');
    }
}
