<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Pour SQLite, on ne peut pas utiliser MODIFY, donc on utilise une approche différente
        if (DB::getDriverName() === 'sqlite') {
            // Supprimer l'ancienne contrainte si elle existe
            DB::statement('PRAGMA foreign_keys = OFF;');
            DB::statement('ALTER TABLE reparations RENAME TO reparations_old;');
            DB::statement('CREATE TABLE reparations (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                vehicule_id INTEGER,
                technicien_id INTEGER NULL,
                date_debut DATE,
                date_fin DATE NULL,
                description TEXT,
                statut TEXT DEFAULT \'en_attente\' CHECK (statut IN (\'en_attente\', \'en_cours\', \'termine\', \'annule\', \'urgent\')),
                created_at DATETIME,
                updated_at DATETIME,
                FOREIGN KEY (vehicule_id) REFERENCES vehicules(id) ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY (technicien_id) REFERENCES techniciens(id) ON DELETE SET NULL ON UPDATE CASCADE
            );');
            DB::statement('INSERT INTO reparations SELECT * FROM reparations_old;');
            DB::statement('DROP TABLE reparations_old;');
            DB::statement('PRAGMA foreign_keys = ON;');
        } else {
            // Pour MySQL/PostgreSQL, utiliser change
            Schema::table('reparations', function (Blueprint $table) {
                $table->enum('statut', ['en_attente', 'en_cours', 'termine', 'annule', 'urgent'])->default('en_attente')->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revenir à l'ancien enum
        if (DB::getDriverName() === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF;');
            DB::statement('ALTER TABLE reparations RENAME TO reparations_old;');
            DB::statement('CREATE TABLE reparations (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                vehicule_id INTEGER,
                technicien_id INTEGER NULL,
                date_debut DATE,
                date_fin DATE NULL,
                description TEXT,
                statut TEXT DEFAULT \'en_attente\' CHECK (statut IN (\'en_attente\', \'en_cours\', \'termine\', \'annule\')),
                created_at DATETIME,
                updated_at DATETIME,
                FOREIGN KEY (vehicule_id) REFERENCES vehicules(id) ON DELETE CASCADE ON UPDATE CASCADE,
                FOREIGN KEY (technicien_id) REFERENCES techniciens(id) ON DELETE SET NULL ON UPDATE CASCADE
            );');
            DB::statement('INSERT INTO reparations SELECT * FROM reparations_old;');
            DB::statement('DROP TABLE reparations_old;');
            DB::statement('PRAGMA foreign_keys = ON;');
        } else {
            Schema::table('reparations', function (Blueprint $table) {
                $table->enum('statut', ['en_attente', 'en_cours', 'termine', 'annule'])->default('en_attente')->change();
            });
        }
    }
};