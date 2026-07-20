<?php

namespace App\Services;

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class TransactionService
{
    public function createSale(
        array $cart,
        float $payment
    ): Sale {

        return DB::transaction(function () use (
            $cart,
            $payment
        ) {

            $grandTotal = collect($cart)
                ->sum('subtotal');

            $sale = Sale::create([
                'invoice' => 'INV-' . now()->format('YmdHis'),
                'total' => $grandTotal,
                'payment' => $payment,
                'change' => $payment - $grandTotal,
            ]);

            foreach ($cart as $item) {

                $product = Product::findOrFail(
                    $item['id']
                );

                $sale->details()->create([
                    'product_id' => $product->id,
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'subtotal' => $item['subtotal'],
                ]);

                $product->decrement(
                    'stock',
                    $item['qty']
                );
            }

            return $sale;
        });
    }
}