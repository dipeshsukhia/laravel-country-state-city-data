<?php

namespace DipeshSukhia\LaravelCountryStateCityData\Console\Commands;

use Database\Seeders\CountryStateCityTableSeeder;
use Illuminate\Console\Command;

class InstallCountryDataPackage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'country-data:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the Country/State/City Data';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return bool
     */
    public function handle(): bool
    {
        $this->info('Installing Country Data...');

        $this->info('Publishing Configuration...');
        $this->publishConfiguration(false);

        $this->call('migrate', [
            '--path' => 'database/migrations/2014_02_04_000000_create_country_state_city_table.php'
        ]);

        $this->call('db:seed', [
            '--class' => CountryStateCityTableSeeder::class
        ]);

        $this->info('Installed Country Data');
        return true;
    }

    private function publishConfiguration($forcePublish = false)
    {
        $params = [
            '--provider' => "DipeshSukhia\LaravelCountryStateCityData\LaravelCountryStateCityDataServiceProvider",
            '--tag' => "LaravelCountryStateCityData"
        ];
        if ($forcePublish === true) {
            $params['--force'] = '';
        }
        $this->call('vendor:publish', $params);
    }
}
