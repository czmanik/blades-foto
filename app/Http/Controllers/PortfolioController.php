<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Category;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $photos = Photo::with('category')->latest()->get();

        return view('portfolio.index', compact('photos', 'categories'));
    }

    public function show($slug)
    {
        // Find project/photo by slug or id
        $photo = Photo::where('slug', $slug)->firstOrFail();
        $related = Photo::where('category_id', $photo->category_id)
            ->where('id', '!=', $photo->id)
            ->take(4)
            ->get();

        return view('portfolio.show', compact('photo', 'related'));
    }
}