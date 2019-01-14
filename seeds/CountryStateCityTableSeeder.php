<?php

use Illuminate\Database\Seeder;
use App\Country;
use App\State;
use App\City;
use App\DataProviders\CountryStateCityDataProvider;


class CountryStateCityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::insert(CountryStateCityDataProvider::Countries());

        State::insert(CountryStateCityDataProvider::States());

        foreach (collect(CountryStateCityDataProvider::Cities())->chunk(15000) as $chunkCities){
            City::insert($chunkCities->toArray());
        }
    }
}