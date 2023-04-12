<?php

namespace Salehhashemi\LaravelDomainExpert;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;

class DomainViewServiceProvider extends ServiceProvider
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

            if (File::exists($viewsPath)) {
                $this->loadViewsFrom($viewsPath, $domainName);
            }
        }
    }
}
