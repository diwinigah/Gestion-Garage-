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
        Schema::table('reparations', function (Blueprint $table) {
            // Supprimer les colonnes obsolètes
            $table->dropColumn(['date', 'duree_main_oeuvre', 'objet_reparation']);
            
            // Ajouter les nouvelles colonnes
            $table->date('date_debut');
            $table->date('date_fin')->nullable();
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reparations', function (Blueprint $table) {
            // Supprimer les nouvelles colonnes
            $table->dropColumn(['date_debut', 'date_fin', 'description']);
            
            // Remettre les colonnes originales
            $table->date('date');
            $table->integer('duree_main_oeuvre')->nullable();
            $table->text('objet_reparation');
        });
    }
};
