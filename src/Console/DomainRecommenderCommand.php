<?php

namespace Salehhashemi\LaravelDomainExpert\Console;

use Illuminate\Console\Command;
use Salehhashemi\LaravelDomainExpert\Services\DomainInspector;
use Salehhashemi\LaravelDomainExpert\Services\ServiceCall;

class DomainRecommenderCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'suggest:domains';

    /**
     * {@inheritdoc}
     */
    protected $description = 'Recommend domain structure for the application.';

    public function __construct(
        private DomainInspector $domainInspector,
        private ServiceCall $serviceCall
    ) {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $controllers = $this->domainInspector->fetchControllers();
        $models = $this->domainInspector->fetchModels();

        $recommendation = $this->serviceCall->recommend($controllers, $models);

        $this->info("AI Recommendation: {$recommendation}");

        return 0;
    }

    // ...
}
