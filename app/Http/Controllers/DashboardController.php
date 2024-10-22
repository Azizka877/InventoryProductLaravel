<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalQuantity = Product::sum('quantity');
        $topProducts = Product::orderBy('quantity', 'desc')->take(5)->get();
        
        $labels = $topProducts->pluck('name');
        $data = $topProducts->pluck('quantity');

        return view('dashboard.index', compact('totalProducts', 'totalQuantity', 'labels', 'data'));
    }
}
