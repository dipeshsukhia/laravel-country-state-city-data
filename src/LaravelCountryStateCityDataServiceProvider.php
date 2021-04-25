<?php

namespace DipeshSukhia\LaravelCountryStateCityData;

use Illuminate\Support\ServiceProvider;

class LaravelCountryStateCityDataServiceProvider extends ServiceProvider
{
    const STUB_DIR = __DIR__.'/resources/stubs/';
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        /*
         * Optional methods to load your package assets
         */

        if ($this->app->runningInConsole()) {
            /* model */
            if(is_dir(base_path('app/Models'))){
                $modelDir = base_path('app/Models');
                $modelNameSpace = "\\Models";
            }else{
                $modelDir = base_path('app');
                $modelNameSpace = "";
            }

            foreach (['Country','State','City'] as $modelName){
                $ModelTemplate = self::getStubContents("Models/{$modelName}.stub");
                $ModelTemplate = str_replace('{{modelNameSpace}}', $modelNameSpace, $ModelTemplate);
                file_put_contents($modelDir."/{$modelName}.php", $ModelTemplate);
            }

            /* model */

            /* seeders */
            if(is_dir(database_path('seeds'))){
                $seedDir = database_path('seeds');
                $seederNameSpace = "";
            }else{
                $seedDir = database_path('seeders');
                $seederNameSpace = "namespace Database\\Seeders;\n";
            }
            $seederTemplate = self::getStubContents('CountryStateCityTableSeeder.stub');
            $seederTemplate = str_replace('{{seederNameSpace}}', $seederNameSpace, $seederTemplate);
            $seederTemplate = str_replace('{{modelNameSpace}}', $modelNameSpace, $seederTemplate);
            file_put_contents($seedDir.'/CountryStateCityTableSeeder.php', $seederTemplate);
            /* seeders */

            $this->publishes([
                __DIR__.'/resources/migrations' => database_path('migrations'),
                __DIR__.'/resources/DataProviders' => app_path('DataProviders'),
            ], 'LaravelCountryStateCityData');

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

    private function getStubContents($stubName)
    {
        return file_get_contents(self::STUB_DIR.$stubName);
    }
}
