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
    Schema::create('perfumes', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->string('marca');
        $table->decimal('preco', 8, 2);
        $table->string('familia_olfativa');
        $table->string('volume');
        $table->foreignId('ficha_tecnica_id')->unique()->constrained('ficha_tecnicas')->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perfumes');
    }
};
