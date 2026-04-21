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
        Schema::create('waste_purchases', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('supplier_id')->constrained('suppliers')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('total_weight', 10, 2);
            $table->decimal('total_amount', 12, 2);
            $table->decimal('amount_paid', 12, 2)->default(0);
            $table->enum('payment_status', ['paid', 'unpaid', 'partial'])->default('unpaid');
            $table->text('notes')->nullable();
            $table->timestamp('purchased_at')->useCurrent();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_purchases');
    }
};
