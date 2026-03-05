<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Photo;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminGalleryController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $photos = Photo::with('category')->latest()->paginate(24);
        return view('admin.gallery.index', compact('photos'));
    }

    public function create()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $categories = Category::whereIn('type', ['portfolio', 'gallery'])->get();
        return view('admin.gallery.create', compact('categories'));
    }

    public function store(Request $request)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'slug'        => 'nullable|string|unique:photos,slug',
            'url'         => 'required|string',
            'type'        => 'required|in:portfolio,gallery',
            'category_id' => 'nullable|exists:categories,id',
            'featured'    => 'boolean',
            'sort_order'  => 'integer',
            'description' => 'nullable|string',
        ]);
        $data['slug'] = $data['slug'] ?? Str::slug($data['title']);
        $data['featured'] = $request->boolean('featured');
        Photo::create($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Fotografie přidána.');
    }

    public function edit($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $photo = Photo::findOrFail($id);
        $categories = Category::whereIn('type', ['portfolio', 'gallery'])->get();
        return view('admin.gallery.edit', compact('photo', 'categories'));
    }

    public function update(Request $request, $id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        $photo = Photo::findOrFail($id);
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'url'         => 'required|string',
            'type'        => 'required|in:portfolio,gallery',
            'category_id' => 'nullable|exists:categories,id',
            'featured'    => 'boolean',
            'sort_order'  => 'integer',
            'description' => 'nullable|string',
        ]);
        $data['featured'] = $request->boolean('featured');
        $photo->update($data);
        return redirect()->route('admin.gallery.index')->with('success', 'Fotografie aktualizována.');
    }

    public function destroy($id)
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');
        Photo::findOrFail($id)->delete();
        return redirect()->route('admin.gallery.index')->with('success', 'Fotografie smazána.');
    }
}