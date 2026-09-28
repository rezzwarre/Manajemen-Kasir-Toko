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
        Schema::create('transaction_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaction_id')->constrained('transactions')->cascadeOnDelete();
            $table->foreignId('variant_id')->constrained('variants')->restrictOnDelete();
            $table->integer('quantity');
            $table->decimal('cost_price_at_sale', 12, 2)->default(0); // Snapshot HPP/Modal saat transaksi untuk hitung laba bersih
            $table->decimal('price_at_sale', 12, 2); // Harga jual saat transaksi
            $table->decimal('discount_amount', 12, 2)->default(0); // Diskon per item jika ada promo
            $table->decimal('subtotal', 12, 2); // (price_at_sale * quantity) - discount_amount
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_items');
    }
};
