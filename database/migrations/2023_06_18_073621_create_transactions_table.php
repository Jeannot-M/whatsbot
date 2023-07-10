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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code_transaction')->unique();
            $table->foreignId('utilisateur_id')->constrained('utilisateurs');
            $table->foreignId('billet_id')->constrained('billets');
            $table->float('montant');
            $table->enum('methode_paiement', ['M-Pesa', 'Airtel-Money', 'Orange']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
