<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Featured projects for homepage grid
        $featuredPhotos = Photo::latest()->take(6)->get();

        // Featured shop products
        $featuredProducts = Product::latest()->take(3)->get();

        return view('welcome', compact('featuredPhotos', 'featuredProducts'));
    }
}