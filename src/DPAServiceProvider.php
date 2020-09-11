<?php

namespace Capitalab\DPA;

use Capitalab\DPA\Console\PublishCommand;
use Capitalab\DPA\Console\SeedDataCommand;
use Illuminate\Support\ServiceProvider;

class DPAServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->runningInConsole()) {
            $this->commands([
                SeedDataCommand::class,
                PublishCommand::class,
            ]);
        }

        $this->loadMigrations();
    }

    /**
     *
     * @return void
     */
    private function loadMigrations()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->publishes([
            __DIR__ . '/../database/migrations' => database_path('migrations'),
        ], 'dpa-migrations');
    }
}
