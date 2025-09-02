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
        Schema::create('paiements', function (Blueprint $table) {
            $table->id();
            $table->date('date_paiement');
            $table->decimal('montant', 10, 2);
            $table->enum('type_paiement', ['salaire', 'remboursement', 'prime', 'indemnite', 'autre'])->default('salaire');
            $table->enum('mode_paiement', ['carte', 'especes', 'cheque', 'orangeMoney'])->default('carte');
            $table->foreignId('employe_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiements');
    }
};
