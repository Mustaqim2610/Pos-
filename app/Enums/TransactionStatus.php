<?php

namespace App\Enums;

enum TransactionStatus: string
{
    case PENDING = 'pending';
    case PAID = 'paid';
    case CANCELLED = 'cancelled';
    case REFUNDED = 'refunded';

    /**
     * Label Indonesia
     */
    public function label(): string
    {
        return match ($this) {
            self::PENDING => 'Menunggu',
            self::PAID => 'Lunas',
            self::CANCELLED => 'Dibatalkan',
            self::REFUNDED => 'Refund',
        };
    }

    /**
     * Badge bootstrap
     */
    public function badge(): string
    {
        return match ($this) {
            self::PENDING => 'warning',
            self::PAID => 'success',
            self::CANCELLED => 'danger',
            self::REFUNDED => 'secondary',
        };
    }

    public static function options(): array
    {
        return [
            self::PENDING->value => self::PENDING->label(),
            self::PAID->value => self::PAID->label(),
            self::CANCELLED->value => self::CANCELLED->label(),
            self::REFUNDED->value => self::REFUNDED->label(),
        ];
    }
}