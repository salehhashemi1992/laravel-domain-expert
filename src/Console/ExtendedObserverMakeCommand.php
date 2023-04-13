<?php

namespace Salehhashemi\LaravelDomainExpert\Console;

use Illuminate\Foundation\Console\ObserverMakeCommand;

class ExtendedObserverMakeCommand extends ObserverMakeCommand
{
    use HandlesDomainOption;

    protected string $folder = 'Observers';

    /**
     * {@inheritdoc}
     */
    public function handle(): bool|null
    {
        $this->handleDomainOption();

        return parent::handle();
    }

    protected function getOptions(): array
    {
        $options = parent::getOptions();
        $options[] = $this->getDomainOption();

        return $options;
    }
}
