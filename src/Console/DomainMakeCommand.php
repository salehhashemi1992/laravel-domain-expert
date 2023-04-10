<?php

namespace Salehhashemi\LaravelDomainExpert\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;

class DomainMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'make:domain';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new domain directory structure.';

    /**
     * The type of files to generate.
     *
     * @var string
     */
    protected string $type = 'Route';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        $domain = $this->argument('domain');
        $domainsDirectory = $this->getDomainsDirectory();

        if (!$this->createNewDomainDirectory($domain, $domainsDirectory)) {
            $this->error("{$domain} domain already exists! Will not overwrite existing domain.");
            return 1;
        }

        $this->info("Domain created successfully in {$domainsDirectory}");

        return 0;
    }

    /**
     * Get the application Domains directory path.
     *
     * @return string
     */
    private function getDomainsDirectory(): string
    {
        $domainDirectory = app_path('Domains');

        if (!file_exists($domainDirectory)) {
            mkdir($domainDirectory);
        }

        return $domainDirectory;
    }

    /**
     * Create a new domain directory with the necessary folders.
     *
     * @param string $domain
     * @param string $domainsDirectory
     * @return bool
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
            'routes'
        ];

        foreach ($folders as $folder) {
            mkdir("{$newDomainDirectory}/{$folder}", 0777, true);
        }

        $this->createController();

        return true;
    }

    /**
     * Create a controller for the new domain.
     *
     * @return void
     */
    protected function createController(): void
    {
        $domain = Str::studly(class_basename($this->argument('domain')));

        $controllerNamespace = "App\\Domains\\{$domain}\\Http\\Controllers";
        $controllerClassName = "{$domain}Controller";
        $controllerPath = app_path("Domains/{$domain}/Http/Controllers");
        $controllerName = "{$controllerNamespace}\\{$controllerClassName}";

        $this->call('custom:make:controller', [
            'name' => $controllerName,
            '--path' => $controllerPath,
        ]);

        /*
        $this->call(
            'domain:make:routes',
            $this->getRoutesOptions($domain)
        );*/
    }

    /**
     * Get the options for creating routes.
     *
     * @param string $domain
     * @return array
     */
    protected function getRoutesOptions(string $domain): array
    {
        return [
            'domain' => $domain,
            'name' => $domain,
            '--controller' => "{$domain}Controller"
        ];
    }

    /**
     * Get the console command arguments.
     *
     * @return array
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