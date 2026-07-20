<?php

namespace App\Enums;

enum Role: string
{
    case ADMIN = 'admin';
    case CASHIER = 'kasir';

    /**
     * Label untuk ditampilkan di view
     */
    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrator',
            self::CASHIER => 'Kasir',
        };
    }

    /**
     * Warna badge bootstrap
     */
    public function badge(): string
    {
        return match ($this) {
            self::ADMIN => 'danger',
            self::CASHIER => 'primary',
        };
    }

    /**
     * Dropdown select
     */
    public static function options(): array
    {
        return [
            self::ADMIN->value => self::ADMIN->label(),
            self::CASHIER->value => self::CASHIER->label(),
        ];
    }
}