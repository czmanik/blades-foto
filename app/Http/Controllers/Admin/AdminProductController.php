<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminProductController extends Controller
{
    private function auth() { if (!session('admin_logged_in')) abort(redirect()->route('admin.login')); }

    public function index()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $products = Product::with('category')->orderBy('sort_order')->paginate(20);
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $categories = Category::where('type', 'shop')->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:products,slug',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|string',
            'in_stock'    => 'boolean',
            'featured'    => 'boolean',
            'sort_order'  => 'integer',
        ]);
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['in_stock'] = $request->boolean('in_stock');
        $data['featured'] = $request->boolean('featured');
        Product::create($data);
        return redirect()->route('admin.products.index')->with('success', 'Produkt vytvořen.');
    }

    public function edit($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $product = Product::findOrFail($id);
        $categories = Category::where('type', 'shop')->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $product = Product::findOrFail($id);
        $data = $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|string|max:255|unique:products,slug,' . $id,
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|string',
            'in_stock'    => 'boolean',
            'featured'    => 'boolean',
            'sort_order'  => 'integer',
        ]);
        $data['slug'] = $data['slug'] ?? Str::slug($data['name']);
        $data['in_stock'] = $request->boolean('in_stock');
        $data['featured'] = $request->boolean('featured');
        $product->update($data);
        return redirect()->route('admin.products.index')->with('success', 'Produkt aktualizován.');
    }

    public function destroy($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        Product::findOrFail($id)->delete();
        return redirect()->route('admin.products.index')->with('success', 'Produkt smazán.');
    }
}