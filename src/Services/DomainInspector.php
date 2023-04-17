<?php

namespace Salehhashemi\LaravelDomainExpert\Services;

use Illuminate\Support\Facades\File;

class DomainInspector
{
    public function fetchControllers(): string
    {
        $appControllersPath = app_path('Http/Controllers');

        return $this->fetchFiles($appControllersPath);
    }

    public function fetchModels(): string
    {
        $appModelsPath = app_path('Models');

        return $this->fetchFiles($appModelsPath);
    }

    private function fetchFiles(string $path): string
    {
        if (! File::exists($path)) {
            return '';
        }

        $files = File::allFiles($path);
        $structure = '';

        foreach ($files as $file) {
            $relativePath = $file->getRelativePath();
            $filename = pathinfo($file)['filename'];
            $extension = pathinfo($file)['extension'];

            // Check if the file is a PHP file and not an interface
            if ($extension === 'php' && ! str_ends_with($filename, 'Interface')) {
                $structure .= $relativePath ? "{$relativePath}/{$filename}\n" : "{$filename}\n";
            }
        }

        return $structure;
    }
}
