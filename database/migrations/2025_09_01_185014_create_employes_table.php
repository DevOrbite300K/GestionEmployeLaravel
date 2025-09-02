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
        Schema::create('employes', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom')->nullable();
            $table->string('telephone')->nullable()->unique();
            $table->string('email')->unique();
            $table->enum('sexe', ['homme', 'femme', 'autre'])->nullable()->default('autre');
            $table->string('password');
            $table->string('adresse')->nullable();
            $table->string('matricule')->nullable()->unique();
            $table->date('date_naissance')->nullable();
            $table->date('date_embauche')->nullable();
            $table->string('photo')->nullable();
            $table->foreignId('departement_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('poste_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employes');
    }
};
