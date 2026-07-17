<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $from = $request->from;
        $to = $request->to;

        $sales = Sale::when($from, function ($query) use ($from) {
                    $query->whereDate('created_at', '>=', $from);
                })
                ->when($to, function ($query) use ($to) {
                    $query->whereDate('created_at', '<=', $to);
                })
                ->get();

        $grandTotal = $sales->sum('total');

        return view('reports.index', compact(
            'sales',
            'grandTotal'
        ));
    }
}