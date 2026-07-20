<?php

namespace App\Services;

use App\Models\Sale;
use Carbon\Carbon;

class ReportService
{
    public function daily(
        string $date
    )
    {
        return Sale::whereDate(
            'created_at',
            $date
        )->get();
    }

    public function monthly(
        int $month,
        int $year
    )
    {
        return Sale::whereMonth(
                'created_at',
                $month
            )
            ->whereYear(
                'created_at',
                $year
            )
            ->get();
    }

    public function between(
        string $start,
        string $end
    )
    {
        return Sale::whereBetween(
            'created_at',
            [
                Carbon::parse($start),
                Carbon::parse($end)
            ]
        )->get();
    }

    public function totalRevenue(
        $sales
    ): float {

        return $sales->sum('total');
    }

    public functi<?php

namespace App\Services;

use App\Models\Sale;
use Carbon\Carbon;

class ReportService
{
    public function daily(
        string $date
    )
    {
        return Sale::whereDate(
            'created_at',
            $date
        )->get();
    }

    public function monthly(
        int $month,
        int $year
    )
    {
        return Sale::whereMonth(
                'created_at',
                $month
            )
            ->whereYear(
                'created_at',
                $year
            )
            ->get();
    }

    public function between(
        string $start,
        string $end
    )
    {
        return Sale::whereBetween(
            'created_at',
            [
                Carbon::parse($start),
                Carbon::parse($end)
            ]
        )->get();
    }

    public function totalRevenue(
        $sales
    ): float {

        return $sales->sum('total');
    }

    public function totalTransactions(
        $sales
    ): int {

        return $sales->count();
    }
}on totalTransactions(
        $sales
    ): int {

        return $sales->count();
    }
}