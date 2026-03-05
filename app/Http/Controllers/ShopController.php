<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::with('category')
            ->when($request->kategorie, function ($q) use ($request) {
                $q->whereHas('category', fn($c) => $c->where('slug', $request->kategorie));
            })
            ->when($request->sort === 'price_asc', fn($q) => $q->orderBy('price', 'asc'))
            ->when($request->sort === 'price_desc', fn($q) => $q->orderBy('price', 'desc'))
            ->when($request->sort === 'newest', fn($q) => $q->latest())
            ->when(!$request->sort, fn($q) => $q->latest())
            ->paginate(12);

        return view('shop.index', compact('products', 'categories'));
    }

    public function show($id)
    {
        $product = Product::with('category')->findOrFail($id);
        $related = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->take(4)
            ->get();

        return view('shop.show', compact('product', 'related'));
    }
}