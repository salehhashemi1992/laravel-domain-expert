<?php

namespace Salehhashemi\LaravelDomainExpert\Tests;

use Illuminate\Support\Facades\File;
use Salehhashemi\LaravelDomainExpert\Console\ExtendedModelMakeCommand;
use Salehhashemi\LaravelDomainExpert\LaravelDomainExpertServiceProvider;

class ExtendedModelMakeCommandConsoleTest extends ConsoleTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function getPackageProviders($app): array
    {
        return [LaravelDomainExpertServiceProvider::class];
    }

    /** @test */
    public function test_creates_a_model_in_the_selected_domain()
    {
        // Set the expected domain
        $expectedDomain = 'SampleDomain';

        $tester = $this->runCommand(ExtendedModelMakeCommand::class, [
            'name' => 'SampleModel',
            '--domain' => $expectedDomain,
        ], [0]);

        $tester->assertCommandIsSuccessful();

        // Check if the model file has been created
        $this->assertTrue(File::exists(app_path("Domains/{$expectedDomain}/Models/SampleModel.php")));
    }
}
