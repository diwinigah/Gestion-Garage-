<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
     // crée une table 'vehicules' avec les colonnes suivantes :
    // id (PK), immatriculation unique obligatoire, marque, modele, couleur nullable, annee nullable, kilometrage nullable, carrosserie nullable, energie nullable, boite nullable, image nullable, timestamps

    public function up(): void
    {
        Schema::create('vehicules', function (Blueprint $table) {
            $table->id();
            $table->string('immatriculation')->unique();
            $table->string('marque');
            $table->string('modele');
            $table->string('couleur')->nullable();
            $table->integer('annee')->nullable();
            $table->integer('kilometrage')->nullable();
            $table->string('carrosserie')->nullable();
            $table->string('energie')->nullable();
            $table->string('boite')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }   
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicules');
    }
};
