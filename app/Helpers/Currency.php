<?php

namespace App\Helpers;

class Currency
{
    /**
     * Format Rupiah
     */
    public static function rupiah(
        float|int $amount
    ): string {

        return 'Rp ' .
            number_format(
                $amount,
                0,
                ',',
                '.'
            );
    }

    /**
     * Format dengan desimal
     */
    public static function decimal(
        float|int $amount,
        int $decimal = 2
    ): string {

        return number_format(
            $amount,
            $decimal,
            ',',
            '.'
        );
    }

    /**
     * Hitung diskon
     */
    public static function discount(
        float $price,
        float $discount
    ): float {

        return $price -
            ($price * $discount / 100);
    }

    /**
     * Hitung pajak
     */
    public static function tax(
        float $price,
        float $tax
    ): float {

        return $price +
            ($price * $tax / 100);
    }
}