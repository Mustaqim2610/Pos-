<?php

namespace App\Helpers;

class Invoice
{
    /**
     * Generate nomor invoice
     */
    public static function generate(): string
    {
        $prefix = 'INV';

        $date = now()->format('Ymd');

        $random = str_pad(
            rand(1, 9999),
            4,
            '0',
            STR_PAD_LEFT
        );

        return "{$prefix}-{$date}-{$random}";
    }

    /**
     * Generate kode transaksi
     */
    public static function transactionCode(): string
    {
        return 'TRX-' .
            now()->format('YmdHis');
    }

    /**
     * Generate nomor struk
     */
    public static function receiptNumber(): string
    {
        return 'RCPT-' .
            strtoupper(
                substr(
                    uniqid(),
                    -8
                )
            );
    }
}