<?php

namespace JoshTaylor\MigrationsGenerator;

use Illuminate\Support\ServiceProvider;

class MigrationsGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Register any application services
     */
    public function register()
    {
        // Register the Generator service provider
        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }

        // Register our commands
        $this->app->singleton('command.josh.generate', function ($app) {
            return $app['JoshTaylor\MigrationsGenerator\GenerateCommand'];
        });

        $this->commands('command.josh.generate');
    }
}
