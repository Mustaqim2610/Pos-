<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        // ── Stat cards ──
        $totalProducts    = Product::count();
        $totalCategories  = Category::count();
        $totalTransactions = Sale::count();
        $totalRevenue     = Sale::sum('total');

        // ── Recent sales ──
        $recentSales = Sale::latest()->take(5)->get();

        // ── Top products by qty sold ──
        $topProducts = Product::select('products.*')
            ->selectRaw('COALESCE(SUM(dt.qty), 0) as total_sold')
            ->leftJoin('detail_transaksis as dt', 'dt.product_id', '=', 'products.id')
            ->groupBy('products.id')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get();

        // ── 6-month sales chart ──
        $months = collect(range(5, 0))->map(fn ($i) => now()->subMonths($i));

        $chartLabels = $months->map(fn ($m) => $m->translatedFormat('M Y'))->values();

        $chartData = $months->map(function ($m) {
            return Sale::whereYear('created_at', $m->year)
                ->whereMonth('created_at', $m->month)
                ->sum('total');
        })->values();

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalTransactions',
            'totalRevenue',
            'recentSales',
            'topProducts',
            'chartLabels',
            'chartData'
        ));
    }
}
