<?php

namespace Salehhashemi\LaravelDomainExpert\Console;

use Symfony\Component\Console\Input\InputOption;

trait HandlesDomainOption
{
    protected function handleDomainOption(): bool|string
    {
        if ($this->option('domain')) {
            $domains = $this->getDomains();

            if (count($domains) === 0) {
                $this->error('No domain folders are available in app/Domains.');

                return false;
            }

            $domain = $this->choice('Which domain would you like to create the class in?', $domains);
            $this->input->setArgument('name', "App\\Domains\\{$domain}\\{$this->folder}\\".$this->argument('name'));
        }

        return true;
    }

    protected function getDomains(): array
    {
        // Retrieve the list of domains from the Domains folder
        $domainsDir = app_path('Domains');
        $domains = array_diff(scandir($domainsDir), ['.', '..']);

        return array_values($domains);
    }

    protected function getDomainOption(): array
    {
        return ['domain', 'd', InputOption::VALUE_NONE, 'Prompt for the domain to create the class in'];
    }
}
