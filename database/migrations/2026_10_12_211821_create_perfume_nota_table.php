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
        Schema::create('perfume_nota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perfume_id')->constrained('perfumes')->onDelete('cascade');
            $table->foreignId('nota_id')->constrained('notas')->onDelete('cascade');
            $table->enum('tipo', ['topo', 'coracao', 'fundo'])->default('topo');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfume_nota');
    }
};
