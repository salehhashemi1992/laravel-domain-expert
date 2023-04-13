<?php

namespace Salehhashemi\LaravelDomainExpert\Tests;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase;
use Salehhashemi\LaravelDomainExpert\LaravelDomainExpertServiceProvider;

class DomainMakeCommandTest extends TestCase
{
    /**
     * {@inheritdoc}
     */
    protected function getPackageProviders($app): array
    {
        return [LaravelDomainExpertServiceProvider::class];
    }

    /** @test */
    public function command_is_registered()
    {
        $commands = Artisan::all();
        $this->assertArrayHasKey('make:domain', $commands);
    }

    /** @test */
    public function creates_new_domain_directory_structure()
    {
        $domainName = 'SampleDomain';

        Artisan::call('make:domain', ['domain' => $domainName]);
        $domainPath = app_path("Domains/{$domainName}");

        $this->assertTrue(File::exists($domainPath), 'Domain directory not created.');

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
            $folderPath = "{$domainPath}/{$folder}";
            $this->assertTrue(File::exists($folderPath), "The {$folder} directory was not created.");
        }

        // Cleanup
        File::deleteDirectory($domainPath);
    }

    /** @test */
    public function creates_sample_controller()
    {
        $domainName = 'SampleDomain';

        Artisan::call('make:domain', ['domain' => $domainName]);
        $controllerPath = app_path("Domains/{$domainName}/Http/Controllers/{$domainName}Controller.php");

        $this->assertTrue(File::exists($controllerPath), 'Controller not created.');

        // Cleanup
        File::deleteDirectory(app_path("Domains/{$domainName}"));
    }

    /** @test */
    public function creates_sample_route_file()
    {
        $domainName = 'SampleDomain';

        Artisan::call('make:domain', ['domain' => $domainName]);
        $routePath = app_path("Domains/{$domainName}/routes/web.php");

        $this->assertTrue(File::exists($routePath), 'Route file not created.');

        // Cleanup
        File::deleteDirectory(app_path("Domains/{$domainName}"));
    }

    /** @test */
    public function does_not_overwrite_existing_domain()
    {
        $domainName = 'ExistingDomain';

        Artisan::call('make:domain', ['domain' => $domainName]);
        $domainPath = app_path("Domains/{$domainName}");

        $this->assertTrue(File::exists($domainPath), 'Domain directory not created.');

        // Run the command with the existing domain
        $this->artisan('make:domain', [
            'domain' => $domainName,
        ])->expectsOutput("{$domainName} domain already exists! Will not overwrite existing domain.");

        // Cleanup
        File::deleteDirectory($domainPath);
    }
}
