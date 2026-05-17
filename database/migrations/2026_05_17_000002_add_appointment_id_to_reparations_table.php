<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('reparations', function (Blueprint $table) {
            $table->foreignId('appointment_id')
                ->nullable()
                ->after('id')
                ->constrained('appointments')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('reparations', function (Blueprint $table) {
            $table->dropConstrainedForeignId('appointment_id');
        });
    }
};
