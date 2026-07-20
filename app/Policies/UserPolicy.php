<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Lihat daftar user
     */
    public function viewAny(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Lihat detail user
     */
    public function view(
        User $user,
        User $model
    ): bool {
        return $user->role === 'admin';
    }

    /**
     * Tambah user
     */
    public function create(User $user): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Edit user
     */
    public function update(
        User $user,
        User $model
    ): bool {
        return $user->role === 'admin';
    }

    /**
     * Hapus user
     */
    public function delete(
        User $user,
        User $model
    ): bool {

        if ($user->id === $model->id) {
            return false;
        }

        return $user->role === 'admin';
    }

    /**
     * Restore user
     */
    public function restore(
        User $user,
        User $model
    ): bool {
        return $user->role === 'admin';
    }

    /**
     * Force delete user
     */
    public function forceDelete(
        User $user,
        User $model
    ): bool {
        return false;
    }
}