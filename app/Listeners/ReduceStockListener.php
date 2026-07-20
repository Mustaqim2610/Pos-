<?php

namespace App\Listeners;

use App\Events\TransactionCreated;
use App\Models\User;
use App\Notifications\LowStockNotification;

class ReduceStockListener
{
    /**
     * Handle the event.
     */
    public function handle(
        TransactionCreated $event
    ): void {

        foreach (
            $event->sale->details
            as $detail
        ) {

            $product = $detail->product;

            $product->decrement(
                'stock',
                $detail->qty
            );

            if ($product->stock <= 5) {

                $admins = User::where(
                    'role',
                    'admin'
                )->get();

                foreach ($admins as $admin) {

                    $admin->notify(
                        new LowStockNotification(
                            $product
                        )
                    );
                }
            }
        }
    }
}