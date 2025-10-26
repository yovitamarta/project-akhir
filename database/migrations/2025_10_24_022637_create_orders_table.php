<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_code')->unique(); // Kode pesanan (contoh: ORD-12345)
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->text('items'); // JSON string: daftar item pesanan
            $table->enum('status', ['pending', 'processing', 'completed', 'cancelled'])->default('pending');
            $table->decimal('total_price', 12, 2)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
