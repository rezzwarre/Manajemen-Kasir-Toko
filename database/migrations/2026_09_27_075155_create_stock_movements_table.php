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
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('variant_id')->constrained('variants')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->enum('type', ['in', 'out', 'sale', 'adjustment', 'return']); // Jenis mutasi stok
            $table->integer('quantity'); // Jumlah penambahan (+ ) atau pengurangan (-)
            $table->integer('stock_before');
            $table->integer('stock_after');
            $table->nullableMorphs('reference'); // reference_type dan reference_id (misal: Transaksi, Retur, Pembelian)
            $table->text('note')->nullable(); // Alasan perubahan stok (misal: barang reject/cacat, stock opname)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};
