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
        Schema::create('batch_materials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('batch_id')->constrained('production_batches')->onDelete('cascade');
            $table->string('material_type');
            $table->decimal('quantity', 10, 2);
            $table->string('unit');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('batch_materials');
    }
};
