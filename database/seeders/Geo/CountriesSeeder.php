<?php

namespace Database\Seeders\Geo;

use Enraiged\Geo\Models\Country;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     *  Seed the enraiged database.
     *
     *  @return void
     */
    public function run()
    {
        $seedfile = \File::get(resource_path('seeds/countries.json'));

        collect( json_decode($seedfile, true) )
            ->each(fn ($parameters)
                => Country::create($parameters));
    }
}
