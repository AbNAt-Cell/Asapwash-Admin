<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);

        \Illuminate\Support\Facades\Event::listen(\Illuminate\Database\Events\StatementPrepared::class, function ($event) {
            if ($event->connection instanceof \Illuminate\Database\SQLiteConnection) {
                $pdo = $event->connection->getPdo();
                $pdo->sqliteCreateFunction('acos', 'acos', 1);
                $pdo->sqliteCreateFunction('cos', 'cos', 1);
                $pdo->sqliteCreateFunction('radians', 'deg2rad', 1);
                $pdo->sqliteCreateFunction('sin', 'sin', 1);
            }
        });
    }
}
