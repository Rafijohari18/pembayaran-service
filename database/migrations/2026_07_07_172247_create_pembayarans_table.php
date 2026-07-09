<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            // order_id cuma referensi id dari service Toko Dapur FYP,
            // sengaja tanpa foreign key constraint karena beda database/service
            $table->unsignedBigInteger('order_id');
            $table->integer('jumlah');
            $table->string('metode')->default('transfer');
            $table->string('status')->default('menunggu');
            $table->timestamp('waktu_bayar')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
