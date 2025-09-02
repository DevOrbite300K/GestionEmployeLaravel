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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->enum('type', ['contrat', 'fiche_de_paie', 'cv', 'diplome', 'autre']);
            $table->enum('typefichier', ['pdf', 'docx', 'jpg', 'png', 'autre'])->nullable();
            $table->text('description')->nullable();
            $table->string('chemin')->nullable();
            $table->foreignId('employe_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};
