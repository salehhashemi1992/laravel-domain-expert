<?php

namespace Salehhashemi\LaravelDomainExpert;

use Illuminate\Support\ServiceProvider;
use Salehhashemi\LaravelDomainExpert\Console\Custom\CustomMakeControllerCommand;
use Salehhashemi\LaravelDomainExpert\Console\DomainMakeCommand;

class LaravelDomainExpertServiceProvider extends ServiceProvider
{
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
                CustomMakeControllerCommand::class
            ]);
        }
    }
}
