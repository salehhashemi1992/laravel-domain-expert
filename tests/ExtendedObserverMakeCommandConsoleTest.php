<?php

namespace Salehhashemi\LaravelDomainExpert\Tests;

use Illuminate\Support\Facades\File;
use Salehhashemi\LaravelDomainExpert\Console\ExtendedObserverMakeCommand;
use Salehhashemi\LaravelDomainExpert\LaravelDomainExpertServiceProvider;

class ExtendedObserverMakeCommandConsoleTest extends ConsoleTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function getPackageProviders($app): array
    {
        return [LaravelDomainExpertServiceProvider::class];
    }

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

    /** @test */
    public function test_creates_an_observer_in_the_selected_domain()
    {
        // Set the expected domain
        $expectedDomain = 'SampleDomain';

        $tester = $this->runCommand(ExtendedObserverMakeCommand::class, [
            'name' => 'SampleObserver',
            '--domain' => true,
        ], [0]);

        $tester->assertCommandIsSuccessful();

        // Check if the observer file has been created
        $this->assertTrue(File::exists(app_path("Domains/{$expectedDomain}/Observers/SampleObserver.php")));
    }
}
