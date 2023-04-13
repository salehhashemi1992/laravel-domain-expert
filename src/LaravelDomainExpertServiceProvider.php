<?php

namespace Salehhashemi\LaravelDomainExpert;

use Illuminate\Support\ServiceProvider;
use Salehhashemi\LaravelDomainExpert\Console\DomainMakeCommand;
use Salehhashemi\LaravelDomainExpert\Console\ExtendedControllerMakeCommand;
use Salehhashemi\LaravelDomainExpert\Console\ExtendedObserverMakeCommand;

class LaravelDomainExpertServiceProvider extends ServiceProvider
{
    /**
     * {@inheritdoc}
     */
    public function register(): void
    {
        $this->app->register(DomainAutoScanServiceProvider::class);
    }

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/domain-expert.php' => config_path('domain-expert.php'),
            ], 'config');

            $this->commands([
                DomainMakeCommand::class,
                ExtendedControllerMakeCommand::class,
                ExtendedObserverMakeCommand::class,
            ]);
        }
    }
}
