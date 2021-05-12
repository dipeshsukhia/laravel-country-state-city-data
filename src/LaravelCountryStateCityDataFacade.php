<?php

namespace DipeshSukhia\LaravelCountryStateCityData;

use Illuminate\Support\Facades\Facade;

class LaravelCountryStateCityDataFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-country-state-city-data';
    }
}
