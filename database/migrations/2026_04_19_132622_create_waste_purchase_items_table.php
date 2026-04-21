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
        Schema::create('waste_purchase_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('waste_purchase_id')->constrained('waste_purchases')->onDelete('cascade');
            $table->foreignId('waste_category_id')->constrained('waste_categories')->onDelete('cascade');
            $table->decimal('weight_kg', 10, 2);
            $table->decimal('price_per_kg', 10, 2);
            $table->decimal('subtotal', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('waste_purchase_items');
    }
};
