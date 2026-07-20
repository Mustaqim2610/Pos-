<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Category;
use App\Models\Sale;
use App\Models\User;

class DashboardService
{
    public function statistics(): array
    {
        return [
            'total_products' => Product::count(),

            'total_categories' => Category::count(),

            'total_users' => User::count(),

            'total_sales' => Sale::count(),

            'revenue' => Sale::sum('total'),

            'latest_sales' => Sale::latest()
                ->take(10)
                ->get(),
        ];
    }
}