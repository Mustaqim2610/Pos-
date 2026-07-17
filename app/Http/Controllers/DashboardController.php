<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Sale;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProduk = Product::count();
        $totalKategori = Category::count();
        $totalUser = User::count();
        $totalPenjualan = Sale::sum('total');

        $penjualanTerbaru = Sale::latest()->take(10)->get();

        return view('dashboard', compact(
            'totalProduk',
            'totalKategori',
            'totalUser',
            'totalPenjualan',
            'penjualanTerbaru'
        ));
    }
}