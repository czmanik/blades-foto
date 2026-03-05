<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Category;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();

        $photos = Photo::with('category')
            ->when($request->kategorie, function ($q) use ($request) {
                $q->whereHas('category', fn($c) => $c->where('slug', $request->kategorie));
            })
            ->latest()
            ->get();

        return view('gallery.index', compact('photos', 'categories'));
    }
}