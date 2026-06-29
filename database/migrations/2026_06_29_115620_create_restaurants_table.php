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
    Schema::create('restaurants', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Dono da avaliação
        $table->string('name');
        $table->string('cuisine_type'); // Ex: Italiana, Tradicional Portuguesa, Japonesa
        $table->decimal('rating', 3, 1); // Nota de 0.0 a 5.0
        $table->text('review')->nullable(); // Comentário opcional
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('restaurants');
    }
};
