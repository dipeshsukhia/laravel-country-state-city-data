<?php

namespace DipeshSukhia\LaravelCountryStateCityData\Console\Commands;

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
        $this->publishConfiguration(true);
        $this->info('Published configuration');

        $this->call('migrate');

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
