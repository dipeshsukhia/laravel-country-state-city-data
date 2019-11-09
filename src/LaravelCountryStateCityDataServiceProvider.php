<?php

namespace DipeshSukhia\LaravelCountryStateCityData;

use Illuminate\Support\ServiceProvider;

class LaravelCountryStateCityDataServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'laravel-country-state-city-data');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'laravel-country-state-city-data');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        if ($this->app->runningInConsole()) {

            $this->publishes([
                __DIR__.'/migrations' => database_path('migrations'),
                __DIR__.'/Models' => app_path(),
                __DIR__.'/DataProviders' => app_path('DataProviders'),
                __DIR__.'/seeds' => database_path('seeds'),
            ], 'LaravelCountryStateCityData');

            /*$this->publishes([
                __DIR__.'/../config/config.php' => config_path('laravel-country-state-city-data.php'),
            ], 'config');*/

            // Publishing the views.
            /*$this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/laravel-country-state-city-data'),
            ], 'views');*/

            // Publishing assets.
            /*$this->publishes([
                __DIR__.'/../resources/assets' => public_path('vendor/laravel-country-state-city-data'),
            ], 'assets');*/

            // Publishing the translation files.
            /*$this->publishes([
                __DIR__.'/../resources/lang' => resource_path('lang/vendor/laravel-country-state-city-data'),
            ], 'lang');*/

            // Registering package commands.
            // $this->commands([]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        // Automatically apply the package configuration
        /*$this->mergeConfigFrom(__DIR__.'/../config/config.php', 'laravel-country-state-city-data');*/

        // Register the main class to use with the facade
        /*$this->app->singleton('laravel-country-state-city-data', function () {
            return new LaravelCountryStateCityData;
        });*/
    }
}
