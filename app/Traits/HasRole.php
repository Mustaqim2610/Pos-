<?php

namespace App\Traits;

trait HasRole
{
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isCashier(): bool
    {
        return $this->role === 'cashier';
    }

    public function hasRole(
        string $role
    ): bool {

        return $this->role === $role;
    }

    public function hasAnyRole(
        array $roles
    ): bool {

        return in_array(
            $this->role,
            $roles
        );
    }
}