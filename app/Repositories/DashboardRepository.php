<?php

namespace App\Repositories;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\Sale;

class DashboardRepository
{
    public function statistics(): array
    {
        return [
            'products' => Product::count(),
            'categories' => Category::count(),
            'users' => User::count(),
            'transactions' => Sale::count(),
            'revenue' => Sale::sum('total'),
        ];
    }

    public function latestSales(
        int $limit = 10
    )
    {
        return Sale::latest()
            ->take($limit)
            ->get();
    }

    public function salesChart()
    {
        return Sale::selectRaw(
                'DATE(created_at) as date,
                 SUM(total) as revenue'
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }

    public function monthlyRevenue()
    {
        return Sale::selectRaw(
                'MONTH(created_at) as month,
                 SUM(total) as total'
            )
            ->groupBy('month')
            ->orderBy('month')
            ->get();
    }

    public function topProducts()
    {
        return Product::orderByDesc('stock')
            ->take(5)
            ->get();
    }

    public function recentActivities()
    {
        return Sale::latest()
            ->take(5)
            ->get();
    }
}