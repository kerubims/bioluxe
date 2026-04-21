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
        Schema::create('production_batches', function (Blueprint $table) {
            $table->id();
            $table->string('batch_number')->unique();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['persiapan', 'fermentasi', 'panen', 'gagal'])->default('persiapan');
            $table->decimal('total_waste_kg', 10, 2);
            $table->decimal('em4_liters', 8, 2)->default(0);
            $table->decimal('molasses_kg', 8, 2)->default(0);
            $table->decimal('water_liters', 10, 2)->default(0);
            $table->date('started_at');
            $table->date('estimated_harvest');
            $table->date('actual_harvest')->nullable();
            $table->decimal('yield_liters', 10, 2)->nullable();
            $table->decimal('solid_waste_kg', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('production_batches');
    }
};
