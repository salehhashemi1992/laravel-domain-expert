<?php

namespace Salehhashemi\LaravelDomainExpert\Console;

use Illuminate\Foundation\Console\ModelMakeCommand;

class ExtendedModelMakeCommand extends ModelMakeCommand
{
    use HandlesDomainOption;

    protected string $folder = 'Models';

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
