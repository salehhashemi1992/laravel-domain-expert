<?php

namespace Salehhashemi\LaravelDomainExpert;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class DomainAutoScanServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        $domainsDirectory = app_path('Domains');

        if (! File::exists($domainsDirectory)) {
            return;
        }

        $domains = File::directories($domainsDirectory);

        foreach ($domains as $domainPath) {
            $domainName = basename($domainPath);

            $viewsPath = $domainPath.'/resources/views';
            $routesPath = $domainPath.'/routes';

            if (File::exists($viewsPath)) {
                $this->loadViewsFrom($viewsPath, $domainName);
            }

            if (File::exists($routesPath)) {
                $this->loadRoutes($domainName, $routesPath);
            }
        }
    }

    /**
     * Load the routes for the domain.
     */
    protected function loadRoutes(string $domainName, string $routesPath): void
    {
        $routeFiles = File::allFiles($routesPath);

        foreach ($routeFiles as $routeFile) {
            Route::namespace("App\\Domains\\{$domainName}\\Http\\Controllers")
                ->group($routeFile->getPathname());
        }
    }
}
