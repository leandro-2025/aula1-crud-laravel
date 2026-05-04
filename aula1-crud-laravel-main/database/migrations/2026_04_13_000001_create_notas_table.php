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
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('aluno_id')->constrained()->onDelete('cascade');
            $table->foreignId('disciplina_id')->constrained()->onDelete('cascade');
            $table->decimal('valor', 4, 2);
            $table->string('tipo', 50);
            $table->date('data_avaliacao');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
