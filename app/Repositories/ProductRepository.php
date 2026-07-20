<?php

namespace App\Repositories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductRepository
{
    public function getAll(
        int $perPage = 10
    ): LengthAwarePaginator
    {
        return Product::with('category')
            ->latest()
            ->paginate($perPage);
    }

    public function getActiveProducts(): Collection
    {
        return Product::with('category')
            ->where('stock', '>', 0)
            ->get();
    }

    public function findById(
        int $id
    ): ?Product
    {
        return Product::with('category')
            ->find($id);
    }

    public function search(
        string $keyword
    ): Collection
    {
        return Product::with('category')
            ->where('name', 'like', "%{$keyword}%")
            ->orWhere('barcode', 'like', "%{$keyword}%")
            ->get();
    }

    public function create(
        array $data
    ): Product
    {
        return Product::create($data);
    }

    public function update(
        Product $product,
        array $data
    ): bool
    {
        return $product->update($data);
    }

    public function delete(
        Product $product
    ): bool
    {
        return $product->delete();
    }

    public function decreaseStock(
        Product $product,
        int $qty
    ): void
    {
        $product->decrement('stock', $qty);
    }

    public function increaseStock(
        Product $product,
        int $qty
    ): void
    {
        $product->increment('stock', $qty);
    }

    public function count(): int
    {
        return Product::count();
    }
}