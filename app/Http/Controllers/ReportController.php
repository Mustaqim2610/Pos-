<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Sale::with('user')
            ->when($request->from, fn ($q, $v) => $q->whereDate('created_at', '>=', $v))
            ->when($request->to,   fn ($q, $v) => $q->whereDate('created_at', '<=', $v));

        $totalRevenue      = (clone $query)->sum('total');
        $totalTransactions = (clone $query)->count();

        $sales = $query->latest()->paginate(15)->withQueryString();

        // Daily chart — last 16 days
        $days = collect(range(15, 0))->map(fn ($i) => now()->subDays($i));

        $dailyLabels = $days->map(fn ($d) => $d->format('d'))->values();

        $dailyData = $days->map(fn ($d) => Sale::whereDate('created_at', $d)->sum('total'))->values();

        return view('laporan.index', compact(
            'sales',
            'totalRevenue',
            'totalTransactions',
            'dailyLabels',
            'dailyData'
        ));
    }
}
