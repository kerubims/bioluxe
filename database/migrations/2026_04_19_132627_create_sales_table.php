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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number')->unique();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->onDelete('set null');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->decimal('total_amount', 12, 2);
            $table->decimal('amount_paid', 12, 2);
            $table->decimal('change_amount', 12, 2)->default(0);
            $table->enum('payment_status', ['paid', 'unpaid', 'partial'])->default('paid');
            $table->enum('payment_method', ['cash', 'transfer'])->default('cash');
            $table->text('notes')->nullable();
            $table->timestamp('sold_at')->useCurrent();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
