<?php

namespace DipeshSukhia\LaravelCountryStateCityData;

use Illuminate\Support\Facades\Facade;

/**
 * @see \DipeshSukhia\LaravelCountryStateCityData\Skeleton\SkeletonClass
 */
class LaravelCountryStateCityDataFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-country-state-city-data';
    }
}
