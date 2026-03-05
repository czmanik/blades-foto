<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Photo;
use App\Models\Category;

class AdminDashboardController extends Controller
{
    public function index()
    {
        if (!session('admin_logged_in')) return redirect()->route('admin.login');

        $totalOrders   = Order::count();
        $newOrders     = Order::where('status', 'new')->count();
        $totalRevenue  = Order::where('status', '!=', 'cancelled')->sum('total');
        $totalProducts = Product::count();
        $totalPhotos   = Photo::count();
        $recentOrders  = Order::latest()->take(8)->get();

        return view('admin.dashboard', compact(
            'totalOrders', 'newOrders', 'totalRevenue', 'totalProducts', 'totalPhotos', 'recentOrders'
        ));
    }
}