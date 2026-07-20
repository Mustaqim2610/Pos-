<?php

namespace App\Repositories;

use App\Models\Category;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryRepository
{
    public function getAll(
        int $perPage = 10
    ): LengthAwarePaginator
    {
        return Category::latest()
            ->paginate($perPage);
    }

    public function list()
    {
        return Category::orderBy('name')
            ->get();
    }

    public function findById(
        int $id
    ): ?Category
    {
        return Category::find($id);
    }

    public function create(
        array $data
    ): Category
    {
        return Category::create($data);
    }

    public function update(
        Category $category,
        array $data
    ): bool
    {
        return $category->update($data);
    }

    public function delete(
        Category $category
    ): bool
    {
        return $category->delete();
    }

    public function count(): int
    {
        return Category::count();
    }
}