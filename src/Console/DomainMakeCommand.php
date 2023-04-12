<?php

namespace Salehhashemi\LaravelDomainExpert\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;

class DomainMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:domain';

    /**
     * {@inheritdoc}
     */
    protected $description = 'Create a new domain directory structure.';

    /**
     * The type of files to generate.
     */
    protected string $type = 'Route';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $domain = $this->argument('domain');
        $domainsDirectory = $this->getDomainsDirectory();

        if (! $this->createNewDomainDirectory($domain, $domainsDirectory)) {
            $this->error("{$domain} domain already exists! Will not overwrite existing domain.");

            return 1;
        }

        $this->info("Domain created successfully in {$domainsDirectory}");

        return 0;
    }

    /**
     * Get the application Domains directory path.
     */
    private function getDomainsDirectory(): string
    {
        $domainDirectory = app_path('Domains');

        if (! file_exists($domainDirectory)) {
            mkdir($domainDirectory);
        }

        return $domainDirectory;
    }

    /**
     * Create a new domain directory with the necessary folders.
     */
    private function createNewDomainDirectory(string $domain, string $domainsDirectory): bool
    {
        $newDomainDirectory = "{$domainsDirectory}/{$domain}";

        if (file_exists($newDomainDirectory)) {
            return false;
        }

        mkdir($newDomainDirectory);

        $folders = [
            'Exceptions',
            'Http/Controllers',
            'Http/Middleware',
            'Http/Requests',
            'Jobs',
            'Models',
            'Repositories',
            'Services',
            'resources/css',
            'resources/js',
            'resources/views',
            'routes',
        ];

        foreach ($folders as $folder) {
            mkdir("{$newDomainDirectory}/{$folder}", 0777, true);
        }

        $this->createController();
        $this->createRoutes($domain, $newDomainDirectory);

        return true;
    }

    /**
     * Create a controller for the new domain.
     */
    protected function createController(): void
    {
        $domain = Str::studly(class_basename($this->argument('domain')));

        $controllerNamespace = "App\\Domains\\{$domain}\\Http\\Controllers";
        $controllerClassName = "{$domain}Controller";
        $controllerName = "{$controllerNamespace}\\{$controllerClassName}";

        $this->call('make:controller', [
            'name' => $controllerName,
        ]);
    }

    /**
     * Create a simple route file with a route group and domain prefix.
     */
    private function createRoutes(string $domain, string $newDomainDirectory): void
    {
        $routeFilePath = "{$newDomainDirectory}/routes/web.php";
        $stubPath = __DIR__.'/stubs/routes.stub';

        $routeFileContent = file_get_contents($stubPath);

        $replace = [
            '{{DummyPrefix}}' => strtolower($domain),
            '{{DummyDomain}}' => $domain,
        ];

        $routeFileContent = str_replace(
            array_keys($replace),
            array_values($replace),
            $routeFileContent
        );

        file_put_contents($routeFilePath, $routeFileContent);
    }

    /**
     * Get the options for creating routes.
     */
    protected function getRoutesOptions(string $domain): array
    {
        return [
            'domain' => $domain,
            'name' => $domain,
            '--controller' => "{$domain}Controller",
        ];
    }

    /**
     * {@inheritdoc}
     */
    protected function getArguments(): array
    {
        return [
            [
                'domain',
                InputArgument::REQUIRED,
                'Name of the domain.',
            ],
        ];
    }
}
