<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('detail_transaksis',
        function (Blueprint $table) {

            $table->id();

            $table->foreignId('transaction_id')
                  ->constrained('transaksis')
                  ->cascadeOnDelete();

           $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnDelete();

            $table->integer('qty');

            $table->bigInteger('price');

            $table->bigInteger('subtotal');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists(
            'detail_transaksis'
        );
    }
};
