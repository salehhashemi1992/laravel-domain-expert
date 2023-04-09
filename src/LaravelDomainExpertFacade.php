<?php

namespace Salehhashemi\LaravelDomainExpert;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Salehhashemi\LaravelDomainExpert\Skeleton\SkeletonClass
 */
class LaravelDomainExpertFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-domain-expert';
    }
}
