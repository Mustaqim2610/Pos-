<?php

namespace App\Policies;

use App\Models\Product;
use App\Models\User;

class ProductPolicy
{
    /**
     * Menampilkan daftar produk.
     */
    public function viewAny(User $user): bool
    {
        return in_array($user->role, ['admin', 'cashier']);
    }

    /**
     * Menampilkan detail produk.
     */
    public function view(User $user, Product $product): bool
    {
        return in_array($user->role, ['admin', 'cashier']);
    }

    /**
     * Menambahkan produk.
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Mengubah produk.
     */
    public function update(User $user, Product $product): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Menghapus produk.
     */
    public function delete(User $user, Product $product): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Mengembalikan produk yang dihapus.
     */
    public function restore(User $user, Product $product): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Menghapus permanen produk.
     */
    public function forceDelete(User $user, Product $product): bool
    {
        return $user->role === 'admin';
    }
}