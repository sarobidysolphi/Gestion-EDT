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
        Schema::create('emplois', function (Blueprint $table) {
            $table->id();
            // Remplace ces lignes :
            $table->foreignId('idprof')->constrained('professeurs', 'idprof')->onDelete('cascade');
            $table->foreignId('idsalle')->constrained('salles', 'idsalle')->onDelete('cascade');
            $table->foreignId('idclasse')->constrained('classes', 'idclasse')->onDelete('cascade');
            $table->string('cours');
            $table->date('date');
            $table->time('heure_debut');
            $table->time('heure_fin');
            $table->string('jour_semaine');
            $table->integer('semaine');
            $table->string('semestre')->default('Semestre 1'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emplois');
    }
};
