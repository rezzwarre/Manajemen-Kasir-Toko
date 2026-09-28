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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('user_id')->constrained('users')->restrictOnDelete();
            $table->dateTime('transaction_date'); // Tanggal dan jam transaksi
            $table->decimal('subtotal', 12, 2)->default(0); // Total kotor sebelum diskon & pajak
            $table->decimal('discount_amount', 12, 2)->default(0); // Potongan diskon/promo
            $table->decimal('tax_amount', 12, 2)->default(0); // PPN / Pajak jika ada
            $table->decimal('total_amount', 12, 2); // Total akhir yang harus dibayar
            $table->decimal('cash_received', 12, 2)->nullable(); // Uang tunai yang diterima dari pembeli
            $table->decimal('change_amount', 12, 2)->nullable(); // Uang kembalian kasir
            $table->string('payment_method'); // cash, qris, debit, transfer
            $table->enum('status', ['paid', 'pending', 'cancelled', 'refunded'])->default('paid');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
