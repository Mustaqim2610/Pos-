<?php

namespace App\Notifications;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LowStockNotification extends Notification
{
    use Queueable;

    public function __construct(
        public Product $product
    ) {}

    /**
     * Delivery Channels
     */
    public function via(
        object $notifiable
    ): array {
        return ['database'];
    }

    /**
     * Store in Database
     */
    public function toArray(
        object $notifiable
    ): array {

        return [

            'title' =>
                'Stok Produk Menipis',

            'message' =>
                $this->product->nama_produk .
                ' tersisa ' .
                $this->product->stock .
                ' unit.',

            'product_id' =>
                $this->product->id,
        ];
    }
}