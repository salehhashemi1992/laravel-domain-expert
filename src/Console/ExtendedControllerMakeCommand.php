<?php

namespace Salehhashemi\LaravelDomainExpert\Console;

use Illuminate\Routing\Console\ControllerMakeCommand;
use Symfony\Component\Console\Input\InputOption;

class ExtendedControllerMakeCommand extends ControllerMakeCommand
{
    /**
     * @inheritdoc
     */
    public function handle(): bool|null
    {
        if ($this->option('domain')) {
            $domain = $this->choice('Which domain would you like to create the controller in?', $this->getDomains());
            $this->input->setArgument('name', "App\\Domains\\{$domain}\\Http\\Controllers\\" . $this->argument('name'));
        }

        return parent::handle();
    }

    /**
     * @return array
     */
    private function getDomains(): array
    {
        // Retrieve the list of domains from the Domains folder
        $domainsDir = app_path('Domains');
        return array_diff(scandir($domainsDir), ['.', '..']);
    }

    /**
     * @inheritdoc
     */
    protected function getOptions(): array
    {
        $options = parent::getOptions();
        $options[] = ['domain', 'd', InputOption::VALUE_NONE, 'Prompt for the domain to create the controller in'];
        return $options;
    }
}