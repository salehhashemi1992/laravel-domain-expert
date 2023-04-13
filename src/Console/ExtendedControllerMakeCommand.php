<?php

namespace Salehhashemi\LaravelDomainExpert\Console;

use Illuminate\Routing\Console\ControllerMakeCommand;

class ExtendedControllerMakeCommand extends ControllerMakeCommand
{
    use HandlesDomainOption;

    protected string $folder = 'Controllers';

    /**
     * {@inheritdoc}
     */
    public function handle(): bool|null
    {
        $this->handleDomainOption();

        return parent::handle();
    }

    /**
     * {@inheritdoc}
     */
    protected function getOptions(): array
    {
        $options = parent::getOptions();
        $options[] = $this->getDomainOption();

        return $options;
    }
}
