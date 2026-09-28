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
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained('products')->cascadeOnDelete();
            $table->string('sku')->unique();
            $table->string('barcode')->nullable()->unique()->index(); // Barcode fisik / scanner kasir
            $table->string('size')->index(); // e.g. S, M, L, XL, XXL, 28, 30, All Size
            $table->string('color')->index(); // e.g. Hitam, Putih, Navy, Sage Green
            $table->decimal('cost_price', 12, 2)->default(0); // HPP / Harga Pokok Pembelian (Modal)
            $table->decimal('price', 12, 2); // Harga Jual ke Konsumen
            $table->unsignedInteger('stock_quantity')->default(0);
            $table->unsignedInteger('min_stock')->default(3); // Peringatan saat stok menipis
            $table->string('image')->nullable(); // Foto spesifik varian warna jika ada
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('variants');
    }
};
