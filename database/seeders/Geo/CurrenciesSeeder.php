<?php

namespace Database\Seeders\Geo;

use Enraiged\Geo\Models\Currency;
use Illuminate\Database\Seeder;

class CurrenciesSeeder extends Seeder
{
    /**
     *  Seed the enraiged database.
     *
     *  @return void
     */
    public function run()
    {
        $seedfile = \File::get(resource_path('seeds/currencies.json'));

        collect( json_decode($seedfile, true) )
            ->each(fn ($parameters)
                => Currency::create($parameters));
    }
}
