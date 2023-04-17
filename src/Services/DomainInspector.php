<?php

namespace Salehhashemi\LaravelDomainExpert\Services;

use Illuminate\Support\Facades\File;

class DomainInspector
{
    public function fetchControllers(): array
    {
        $controllers = [];
        $appControllersPath = app_path('Http/Controllers');
        $domainsPath = app_path('Domains');

        $controllers = array_merge($controllers, $this->fetchFiles($appControllersPath, 'Controller'));

        if (File::exists($domainsPath)) {
            $domains = File::directories($domainsPath);
            foreach ($domains as $domain) {
                $domainControllersPath = $domain.'/Http/Controllers';
                $controllers = array_merge($controllers, $this->fetchFiles($domainControllersPath, 'Controller'));
            }
        }

        return $controllers;
    }

    public function fetchModels(): array
    {
        $models = [];
        $appModelsPath = app_path('Models');
        $domainsPath = app_path('Domains');

        $models = array_merge($models, $this->fetchFiles($appModelsPath, 'Model'));

        if (File::exists($domainsPath)) {
            $domains = File::directories($domainsPath);
            foreach ($domains as $domain) {
                $domainModelsPath = $domain.'/Models';
                $models = array_merge($models, $this->fetchFiles($domainModelsPath, 'Model'));
            }
        }

        return $models;
    }

    private function fetchFiles(string $path, string $type): array
    {
        if (! File::exists($path)) {
            return [];
        }

        $files = File::files($path);
        $items = [];

        foreach ($files as $file) {
            $filename = pathinfo($file)['filename'];
            if ($type === 'Controller') {
                $filename = str_replace('Controller', '', $filename);
            }
            $items[] = $filename;
        }

        return $items;
    }
}
