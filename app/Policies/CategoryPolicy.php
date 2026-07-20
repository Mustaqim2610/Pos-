<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Category;

class CategoryPolicy
{
    /**
     * Lihat daftar kategori
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Lihat detail kategori
     */
    public function view(
        User $user,
        Category $category
    ): bool {
        return true;
    }

    /**
     * Tambah kategori
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Update kategori
     */
    public function update(
        User $user,
        Category $category
    ): bool {
        return $user->role === 'admin';
    }

    /**
     * Hapus kategori
     */
    public function delete(
        User $user,
        Category $category
    ): bool {
        return $user->role === 'admin';
    }

    /**
     * Restore kategori
     */
    public function restore(
        User $user,
        Category $category
    ): bool {
        return $user->role === 'admin';
    }

    /**
     * Force delete kategori
     */
    public function forceDelete(
        User $user,
        Category $category
    ): bool {
        return $user->role === 'admin';
    }
}