<?php

use Illuminate\Support\ServiceProvider;

class MigrationsGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Register any application services
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');
        }
    }
}
