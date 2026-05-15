<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // Copilot, crée la table 'reparations' avec :
// id,
// vehicule_id (foreign key vers vehicules.id, on update cascade, on delete cascade),
// technicien_id nullable (foreign key vers techniciens.id, on update cascade, on delete set null),
// date,
// duree_main_oeuvre nullable (int),
// objet_reparation (text),
// timestamps
    public function up(): void
    {
        Schema::create('reparations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('vehicule_id')->constrained('vehicules')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('technicien_id')->nullable()->constrained('techniciens')->onDelete('set null')->onUpdate('cascade');
            $table->date('date');
            $table->integer('duree_main_oeuvre')->nullable();
            $table->text('objet_reparation');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reparations');
    }
};
