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
        Schema::table('techniciens', function (Blueprint $table) {
            $table->string('telephone')->nullable();
            $table->string('email')->nullable();
            $table->enum('statut', ['actif', 'inactif', 'conge'])->default('actif');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('techniciens', function (Blueprint $table) {
            $table->dropColumn(['telephone', 'email', 'statut']);
        });
    }
};
