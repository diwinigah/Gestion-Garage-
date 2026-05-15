<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Events\DatabaseRefreshed;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Activer les contraintes de clés étrangères pour SQLite
        if (env('DB_CONNECTION') === 'sqlite') {
            DB::statement('PRAGMA foreign_keys=ON');
        }
    }
}
