<?php

namespace App\Traits;

trait HasInvoice
{
    public function generateInvoice(): string
    {
        $prefix = 'INV';

        $date = now()->format('Ymd');

        $random = mt_rand(
            1000,
            9999
        );

        return $prefix .
            '-' .
            $date .
            '-' .
            $random;
    }

    public function generateTransactionCode(): string
    {
        return 'TRX-' .
            now()->format('YmdHis');
    }

    public function generateReceiptNumber(): string
    {
        return 'RCPT-' .
            strtoupper(
                substr(
                    md5(
                        uniqid()
                    ),
                    0,
                    8
                )
            );
    }
}