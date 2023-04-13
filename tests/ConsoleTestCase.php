<?php

namespace Salehhashemi\LaravelDomainExpert\Tests;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Symfony\Component\Console\Tester\CommandTester;

abstract class ConsoleTestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        // Create a sample domain for testing purposes
        $this->artisan('make:domain', ['domain' => 'SampleDomain']);
    }

    protected function tearDown(): void
    {
        // Delete the SampleDomain directory after each test
        File::deleteDirectory(app_path('Domains/SampleDomain'));

        parent::tearDown();
    }

    protected function runCommand(string $command, array $arguments = [], array $interactiveInput = []): CommandTester
    {
        $this->withoutMockingConsoleOutput();

        $command = new $command(new Filesystem());
        $command->setLaravel($this->app);

        $command->setLaravel($this->app);

        $tester = new CommandTester($command);
        $tester->setInputs($interactiveInput);

        $tester->execute($arguments);

        return $tester;
    }
}
