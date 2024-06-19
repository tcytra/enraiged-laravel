<?php

namespace Database\Seeders\Geo;

use App\Project\Addresses\Models\Country;
use App\Project\Addresses\Models\Region;
use Illuminate\Database\Seeder;

class RegionsSeeder extends Seeder
{
    /**
     *  Seed the enraiged database.
     *
     *  @return void
     */
    public function run()
    {
        $seedfile = \File::get(resource_path('seeds/regions.json'));

        collect( json_decode($seedfile, true) )
            ->each(function ($parameters) {
                $parameters = collect($parameters)
                    ->merge(['country_id' => Country::where('code', $parameters['country_code'])->first()->id])
                    ->except('country_code')
                    ->toArray();
                Region::create($parameters);
            });
    }
}
