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

            $table->string('kode_invoice')
                  ->unique();

            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            $table->bigInteger('total_harga');

            $table->bigInteger('bayar');

            $table->bigInteger('kembalian');

            $table->enum(
                'status',
                ['Lunas','Pending']
            )->default('Lunas');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};