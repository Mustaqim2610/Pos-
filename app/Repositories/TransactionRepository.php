<?php

namespace App\Repositories;

use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TransactionRepository
{
    public function getAll(
        int $perPage = 15
    ): LengthAwarePaginator
    {
        return Sale::latest()
            ->paginate($perPage);
    }

    public function findById(
        int $id
    ): ?Sale
    {
        return Sale::find($id);
    }

    public function create(
        array $data
    ): Sale
    {
        return Sale::create($data);
    }

    public function delete(
        Sale $sale
    ): bool
    {
        return $sale->delete();
    }

    public function transaction(
        callable $callback
    )
    {
        return DB::transaction($callback);
    }

    public function totalRevenue(): float
    {
        return Sale::sum('total');
    }

    public function totalTransactions(): int
    {
        return Sale::count();
    }

    public function todayRevenue(): float
    {
        return Sale::whereDate(
            'created_at',
            today()
        )->sum('total');
    }

    public function todayTransactions(): int
    {
        return Sale::whereDate(
            'created_at',
            today()
        )->count();
    }

    public function latest(
        int $limit = 10
    )
    {
        return Sale::latest()
            ->take($limit)
            ->get();
    }
}