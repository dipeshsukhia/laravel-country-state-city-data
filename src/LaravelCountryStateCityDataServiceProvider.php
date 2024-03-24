<?php

namespace DipeshSukhia\LaravelCountryStateCityData;

use DipeshSukhia\LaravelCountryStateCityData\Console\Commands\InstallCountryDataPackage;
use Illuminate\Support\ServiceProvider;

class LaravelCountryStateCityDataServiceProvider extends ServiceProvider
{
    const STUB_DIR = __DIR__ . '/resources/stubs/';

    /**
     * Bootstrap the application services.
     */
    public function boot()
    {

        if ($this->app->runningInConsole()) {

            /* model */
            if (is_dir(base_path('app/Models'))) {
                $modelDir = base_path('app/Models');
                $modelNameSpace = "\\Models";
            } else {
                $modelDir = base_path('app');
                $modelNameSpace = "";
            }

            foreach (['Country', 'State', 'City'] as $modelName) {
                $ModelTemplate = $this->getStubContents( "Models/" . $modelName . ".stub");
                $ModelTemplate = str_replace('{{modelNameSpace}}', $modelNameSpace, $ModelTemplate);
                file_put_contents($modelDir . "/" . $modelName . ".php", $ModelTemplate);
            }
            /* model */

            /* seeders */
            if (is_dir(database_path('seeds'))) {
                $seedDir = database_path('seeds');
                $seederNameSpace = "";
            } else {
                $seedDir = database_path('seeders');
                $seederNameSpace = "namespace Database\\Seeders;\n";
            }
            $seederTemplate = $this->getStubContents('seeders/CountryStateCityTableSeeder.stub');
            $seederTemplate = str_replace('{{seederNameSpace}}', $seederNameSpace, $seederTemplate);
            $seederTemplate = str_replace('{{modelNameSpace}}', $modelNameSpace, $seederTemplate);
            file_put_contents($seedDir . '/CountryStateCityTableSeeder.php', $seederTemplate);
            /* seeders */

            /* stubs */
            $this->publishes([
                __DIR__ . '/resources/stubs/migrations/2014_02_04_000000_create_country_state_city_table.stub' => database_path('migrations/2014_02_04_000000_create_country_state_city_table.php'),
                __DIR__ . '/resources/stubs/DataProviders/CountryDataProvider.stub' => app_path('DataProviders/CountryDataProvider.php'),
                __DIR__ . '/resources/stubs/DataProviders/StateDataProvider.stub' => app_path('DataProviders/StateDataProvider.php'),
                __DIR__ . '/resources/stubs/DataProviders/CityDataProvider.stub' => app_path('DataProviders/CityDataProvider.php'),
            ], 'LaravelCountryStateCityData');
            /* stubs */

            // Registering package commands.
            $this->commands([
                InstallCountryDataPackage::class,
            ]);
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }

    private function getStubContents( string $stubName )
    {
        return file_get_contents(self::STUB_DIR . $stubName);
    }
}
