<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {

            $table->id();

            $table->string('invoice')
                  ->unique();

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->bigInteger('total');

            $table->bigInteger('paid');

            $table->bigInteger('change');

            $table->enum(
                'status',
                ['paid', 'pending', 'cancelled', 'refunded']
            )->default('paid');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};